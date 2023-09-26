<?php

class ItemModel
{

    public $connect;

    public function __construct()
    {

        $con = new ConnectDb();
        $this->connect = $con->connection();

    }

    public function createItem($data){

        $sql = "
            INSERT INTO itens(item, qtdItem) VALUES ('{$data['itemText']}', {$data['qtdItemNumber']});
        ";

        $itemCreate = mysqli_query($this->connect, $sql);
        if(!$itemCreate){
            return ['error' => mysqli_connect_error()];
        }
        
        return $itemCreate;

    }

    public function getItens(){

        $arrayItens = [];

        $sql = "SELECT * FROM itens;";
        
        $getItens = mysqli_query($this->connect, $sql);
        if(!$getItens){
            return ['error' => mysqli_connect_error()];
        }

        if($getItens->num_rows == 0){
            return ['error' => 'Não foi encontrado nenhum item.'];
        }

        while($row = mysqli_fetch_array($getItens, MYSQLI_ASSOC)){
      
            array_push($arrayItens, $row);
        
        }

        return $arrayItens;

    }

    public function getItemById($id){

        $sql = "SELECT * FROM itens WHERE id = {$id};";

        $buscaItens = mysqli_query($this->connect, $sql);
        if(!$buscaItens){
            return ['error' => mysqli_connect_error()];
        }
        if($buscaItens->num_rows == 0){
            return ['error' => 'Não foi identificado nenhum item com o id informado'];
        }

        return mysqli_fetch_array($buscaItens, MYSQLI_ASSOC);

    }

    public function updateItem($id, $data){

        $sql = "
            UPDATE itens SET item = '{$data['itemTextEdit']}', qtdItem = {$data['qtdItemNumberEdit']}, hora_update = '{$data['hora_update']}' WHERE id = {$id};
        ";

        $itemUpdate = mysqli_query($this->connect, $sql);
        if(!$itemUpdate){
            return ['error' => mysqli_connect_error()];
        }
        
        return $itemUpdate;

    }

    public function deleteItensById($id){

        $sql = "DELETE FROM itens WHERE id = {$id};";

        $itemDelete = mysqli_query($this->connect, $sql);
        if(!$itemDelete){
            return ['error' => mysqli_connect_error()];
        }
        
        return $itemDelete;

    }

}