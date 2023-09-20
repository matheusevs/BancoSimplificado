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

}