<?php

require_once(RELATIVE_PATH . '/src/models/ItemModel.php');

class ItemController
{

    public $ItemModel;

    public function __construct()
    {
        
        $this->ItemModel = new ItemModel();

    }

    public function saveItem($body)
    {

        $validateFields = $this->validateFields($body, 'create');
        if($validateFields['error']){
            return $validateFields;
        }

        $ItemModel = new ItemModel();
        if(!$ItemModel->createItem($body)){
            return ['error' => 'Não foi possível cadastrar um item.'];
        }

    }

    public function getItens(){

        $getItens = $this->ItemModel->getItens();
        return $getItens;

    }

    public function getItemById($id){

        $getItem = $this->ItemModel->getItemById($id);
        return $getItem;

    }

    public function updateItensById($id, $data){
        
        if(empty($id)){
            return ['error' => 'Id não informado'];
        }

        $validateFields = $this->validateFields($data, 'edit');
        if($validateFields['error']){
            return $validateFields;
        }

        $data['hora_update'] = date('Y-m-d H:i:s');

        if(!$this->ItemModel->updateItem($id, $data)){
            return ['error' => 'Não foi possível atualizar o item.'];
        }
        
    }

    public function deleteItensById($id){

        if(empty($id)){
            return ['error' => 'Id não informado'];
        }

        if(!$this->ItemModel->deleteItensById($id)){
            return ['error' => 'Não foi possível deletar o item.'];
        }

    }

    public function validateFields(array $body, $type)
    {

        if(empty($body)){
            return ['error' => 'O corpo da requisição não pode estar vazio.'];
        }

        if($type == 'edit'){
            if(!isset($body['itemTextEdit']) || empty($body['itemTextEdit'])){
                return ['error' => 'O campo de item é obrigatório.'];
            }
    
            if(!isset($body['qtdItemNumberEdit']) || empty($body['qtdItemNumberEdit']) || !is_numeric($body['qtdItemNumberEdit'])){
                return ['error' => 'O campo de quantidade é obrigatório.'];
            }
        } else {
            if(!isset($body['itemText']) || empty($body['itemText'])){
                return ['error' => 'O campo de item é obrigatório.'];
            }
    
            if(!isset($body['qtdItemNumber']) || empty($body['qtdItemNumber']) || !is_numeric($body['qtdItemNumber'])){
                return ['error' => 'O campo de quantidade é obrigatório.'];
            }
        }

    }

}