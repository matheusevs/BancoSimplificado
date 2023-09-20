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
            return ['error' => mysqli_error($this->connect)];
        }
        
        return $itemCreate;

    }

    public function getItens(){

        $arrayItens = [];

        $sql = "SELECT * FROM itens;";
        
        $getItens = mysqli_query($this->connect, $sql);
        if(!$getItens){
            return ['error' => mysqli_error($this->connect)];
        }

        if($getItens->num_rows == 0){
            return ['error' => 'Não foi encontrado nenhum item.'];
        }

        while($row = mysqli_fetch_array($getItens, MYSQLI_ASSOC)){
      
            array_push($arrayItens, $row);
        
        }

        return $arrayItens;

    }

}