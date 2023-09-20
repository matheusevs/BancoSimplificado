<?php

require_once(RELATIVE_PATH . '/src/models/ItemModel.php');

class ItemController
{

    public $ItemModel;

    public function __construct()
    {
        
        $this->ItemModel = new ItemModel();

    }

    public static function saveItem($body)
    {

        if(empty($body)){
            return ['error' => 'O corpo da requisição não pode estar vazio.'];
        }

        if(!isset($body['itemText']) || empty($body['itemText'])){
            return ['error' => 'O campo de item é obrigatório.'];
        }

        if(!isset($body['qtdItemNumber']) || empty($body['qtdItemNumber']) || !is_numeric($body['qtdItemNumber'])){
            return ['error' => 'O campo de quantidade de itens é obrigatório.'];
        }

        $ItemModel = new ItemModel();
        if(!$ItemModel->createItem($body)){
            return ['error' => 'Não foi possível cadastrar um item.'];
        }

    }

}