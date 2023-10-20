<?php

require_once(RELATIVE_PATH . '/ConnectDb.php');

class TransactionModel
{

    public $connect;

    public function __construct()
    {

        $con = new ConnectDb();
        $this->connect = $con->connection();

    }
    
    public function getBankAccount($id, $idUw){

        $sql = "
            SELECT 
                uw.id as idConta,
                uw.balance as valorConta
            FROM 
                users u
            INNER JOIN 
                user_wallet uw ON u.id = uw.user_id
            WHERE
                u.id = {$id} {$idUw};
        ";

        $userWallet = mysqli_query($this->connect, $sql);
        if(!$userWallet){
            return ['error' => mysqli_error($this->connect)];
        }
        if($userWallet->num_rows == 0){
            return ['error' => 'Não foi identificado nenhum usuário com o id informado'];
        }

        return mysqli_fetch_array($userWallet, MYSQLI_ASSOC);

    }

    public function getExtract($id){
        
        $arrExtracts = [];

        $sql = "
            SELECT
                CASE
                    WHEN payer_id = {$id} THEN 'Transferência Enviada'
                    WHEN payee_id = {$id} THEN 'Transferência Recebida'
                END AS tipo,
                value,
                registration_time,
                update_time
            FROM transfers
            WHERE payer_id = {$id} OR payee_id = {$id};
        ";

        $getExtract = mysqli_query($this->connect, $sql);
        if(!$getExtract){
            return ['error' => mysqli_error($this->connect)];
        }
        if($getExtract->num_rows == 0){
            return ['error' => 'Nenhuma transferência realizada.'];
        }

        while($row = mysqli_fetch_array($getExtract, MYSQLI_ASSOC)){
    
            array_push($arrExtracts, $row);
        
        }

        return $arrExtracts;

    }

    public function destinationAccount($id){
        
        $sql = "
            SELECT 
                *
            FROM 
                user_wallet uw 
            INNER JOIN 
                users u ON uw.user_id = u.id
            WHERE 
                uw.id = {$id};
        ";

        $userWalletDestionation = mysqli_query($this->connect, $sql);
        if(!$userWalletDestionation){
            return ['error' => mysqli_error($this->connect)];
        }
        if($userWalletDestionation->num_rows == 0){
            return ['error' => 'A conta de destino não existe'];
        }

        return mysqli_fetch_array($userWalletDestionation, MYSQLI_ASSOC);

    }

    public function modifyBalance($value, $payee){

        $date = date('Y-m-d H:i:s');

        $sql = "
            UPDATE user_wallet
            SET balance = {$value}, update_time = '{$date}'
            WHERE id = {$payee};
        ";

        $modifyBalance = mysqli_query($this->connect, $sql);
        if(!$modifyBalance){
            return ['error' => mysqli_error($this->connect)];
        }

        return $modifyBalance;

    }

    public function transfersRegister($value, $payerId, $payeeId){

        $sql = "
            INSERT INTO transfers (payer_id, payee_id, value)
            VALUES ({$payerId}, {$payeeId}, {$value});
        ";

        $transfersRegister = mysqli_query($this->connect, $sql);
        if(!$transfersRegister){
            return ['error' => mysqli_error($this->connect)];
        }
        
        return $transfersRegister;

    }

}