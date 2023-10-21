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

        try {

            $this->validateFields($body);

            $objUser = $this->UserController->convertToken($token);
            $account = $this->getBankAccount($objUser->id, " AND uw.id = {$body['idUw']}");

            if($body['idUw'] == $body['destino']){
                throw new Exception('Você não pode enviar uma transferência para sua própria conta!');
            }

            $destinationAccount = $this->TransactionModel->destinationAccount($body['destino']);
            if($destinationAccount['error']){
                throw new Exception($destinationAccount['error']);
            }

            if($body['valor'] > $account['valorConta']){
                throw new Exception("Você não pode enviar uma transferência do valor informado, pois ele é superior ao seu saldo de R$ {$account['valorConta']}!");
            }

            $this->getAuthorization();
            $this->transfer($body['valor'], $account['valorConta'], $destinationAccount['balance'], $body['idUw'], $body['destino']);
            $this->transfersRegister($body['valor'], $body['idUw'], $body['destino']);

            if($token){
                $userLogRegister = $this->UserModel->registerLogUser($objUser->id, "transaction", "Usuário {$objUser->email} realizou uma transferência. IP: {$_SERVER['REMOTE_ADDR']}");
                if(isset($userLogRegister['error'])){
                    return ['message' => "Usuário realizou a transferência com sucesso, contudo, ocorreu um erro na criação do log. Erro: {$userLogRegister['error']}"];
                }
            }

            return ['message' => 'Transferência realizada com sucesso!'];

        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }

    }

    public function getBankAccount($id, $idUw = ''){
            
        $account = $this->TransactionModel->getBankAccount($id, $idUw);
        if($account['error']){
            throw new Exception($account['error']);
        }
        return $account;

    }

    public function getExtract($id){

        return $this->TransactionModel->getExtract($id);

    }

    public function transfer($value, $balance, $balanceDestionation, $payerId, $payeeId){

        $currentBalanceDestionation = ($balanceDestionation + $value);
        $addValuePayee = $this->TransactionModel->modifyBalance($currentBalanceDestionation, $payeeId);
        if($addValuePayee['error']){
            throw new Exception($addValuePayee['error']);
        }

        $currentBalance = ($balance - $value);
        $withdrawValuePayer = $this->TransactionModel->modifyBalance($currentBalance, $payerId);
        if($withdrawValuePayer['error']){
            throw new Exception($withdrawValuePayer['error']);
        }

    }

    public function transfersRegister($value, $payerId, $payeeId){

        $transfersRegister = $this->TransactionModel->transfersRegister($value, $payerId, $payeeId);        
        if($transfersRegister['error']){
            throw new Exception($transfersRegister['error']);
        }

    }

    public function getAuthorization(){

        $mockyAutorizacao = 'https://run.mocky.io/v3/6aa9fe11-bc36-4168-b9fd-8dfd4452e7b9';
        $response = file_get_contents($mockyAutorizacao);
        
        if($response === false){
            throw new Exception('Erro ao fazer a requisição.');
        }
        
        $data = json_decode($response);

        if($data->message != 'Autorizado'){
            throw new Exception('Ocorreu um erro ao realizar a transferência, tente novamente mais tarde.');
        }

    }

    private function validateFields($body){

        if(empty($body)){
            throw new Exception('O corpo da requisição não pode estar vazio.');
        }

        if(!isset($body['idUw']) || empty($body['idUw'])){
            throw new Exception('Reinicie a página!');
        }

        if(!isset($body['destino']) || empty($body['destino'])){
            throw new Exception('O campo de destino é obrigatório.');
        }

        if(!isset($body['valor']) || empty($body['valor'])){
            throw new Exception('O campo de valor é obrigatório.');
        }

    }

}