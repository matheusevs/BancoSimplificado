<?php

require_once(RELATIVE_PATH . '/src/models/TransactionModel.php');
require_once(RELATIVE_PATH . '/src/models/UserModel.php');


class TransactionController
{

    public $TransactionModel;
    public $UserController;
    public $UserModel;

    public function __construct()
    {
        
        $this->TransactionModel = new TransactionModel();
        $this->UserController = new UserController();
        $this->UserModel = new UserModel();

    }

    public function makeTransfer($body, $token){

        $validateFields = $this->validateFields($body);
        if($validateFields['error']){
            return $validateFields;
        }

        $objUser = $this->UserController->convertToken($token);
        $account = $this->getBankAccount($objUser->id, " AND uw.id = {$body['idUw']}");
        if($account['error']){
            return $account;
        }

        if($body['idUw'] == $body['destino']){
            return ['error' => 'Você não pode enviar uma transferência para sua própria conta!'];
        }

        $destinationAccount = $this->TransactionModel->destinationAccount($body['destino']);
        if($destinationAccount['error']){
            return $destinationAccount;
        }

        if($body['valor'] > $account['valorConta']){
            return ['error' => "Você não pode enviar uma transferência do valor informado, pois ele é superior ao seu saldo de R$ {$account['valorConta']}!"];
        }

        $getAuthorization = $this->getAuthorization();
        if($getAuthorization['error']){
            return $getAuthorization;
        }
        
        $transfer = $this->transfer($body['valor'], $account['valorConta'], $destinationAccount['balance'], $body['idUw'], $body['destino']);
        if($transfer['error']){
            return $transfer;
        }

        $transfersRegister = $this->transfersRegister($body['valor'], $body['idUw'], $body['destino']);
        if($transfersRegister['error']){
            return $transfersRegister;
        }

        if($token){
            $userLogRegister = $this->UserModel->registerLogUser($objUser->id, "transaction", "Usuário {$objUser->email} realizou uma transferência. IP: {$_SERVER['REMOTE_ADDR']}");
            if(isset($userLogRegister['error'])){
                return ['message' => "Usuário realizou a transferência com sucesso, contudo, ocorreu um erro na criação do log. Erro: {$userLogRegister['error']}"];
            }
        }

        return ['message' => 'Transferência realizada com sucesso!'];

    }

    public function getBankAccount($id, $idUw = ''){
            
        return $this->TransactionModel->getBankAccount($id, $idUw);

    }

    public function transfer($value, $balance, $balanceDestionation, $payerId, $payeeId){

        $currentBalanceDestionation = ($balanceDestionation + $value);
        $addValuePayee = $this->TransactionModel->modifyBalance($currentBalanceDestionation, $payeeId);
        if($addValuePayee['error']){
            return $addValuePayee;
        }

        $currentBalance = ($balance - $value);
        $withdrawValuePayer = $this->TransactionModel->modifyBalance($currentBalance, $payerId);
        if($withdrawValuePayer['error']){
            return $withdrawValuePayer;
        }

    }

    public function transfersRegister($value, $payerId, $payeeId){

        $transfersRegister = $this->TransactionModel->transfersRegister($value, $payerId, $payeeId);        
        if($transfersRegister['error']){
            return $transfersRegister;
        }

    }

    public function getAuthorization(){

        $mockyAutorizacao = 'https://run.mocky.io/v3/6aa9fe11-bc36-4168-b9fd-8dfd4452e7b9';
        $response = file_get_contents($mockyAutorizacao);
        
        if($response === false){
            return ['error' => 'Erro ao fazer a requisição.'];
        }
        
        $data = json_decode($response);

        if($data->message != 'Autorizado'){
            return ['error' => 'Ocorreu um erro ao realizar a transferência, tente novamente mais tarde.'];
        }

    }

    public function validateFields($body){

        if(empty($body)){
            return ['error' => 'O corpo da requisição não pode estar vazio.'];
        }

        if(!isset($body['idUw']) || empty($body['idUw'])){
            return ['error' => 'Reinicie a página!'];
        }

        if(!isset($body['destino']) || empty($body['destino'])){
            return ['error' => 'O campo de destino é obrigatório.'];
        }

        if(!isset($body['valor']) || empty($body['valor'])){
            return ['error' => 'O campo de valor é obrigatório.'];
        }

    }

}