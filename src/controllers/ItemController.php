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

    public function validateFields($body, $type){

        if(empty($body)){
            return ['error' => 'O corpo da requisição não pode estar vazio.'];
        }

        if($type == 'edit'){
            if(!isset($body['nomeTextEdit']) || empty($body['nomeTextEdit'])){
                return ['error' => 'O campo de nome é obrigatório.'];
            }
    
            if(!isset($body['consumoNumberEdit']) || empty($body['consumoNumberEdit']) || !is_numeric($body['consumoNumberEdit'])){
                return ['error' => 'O campo de consumo é obrigatório.'];
            }
        } else {
            if(!isset($body['nomeText']) || empty($body['nomeText'])){
                return ['error' => 'O campo de nome é obrigatório.'];
            }
    
            if(!isset($body['consumoNumber']) || empty($body['consumoNumber']) || !is_numeric($body['consumoNumber'])){
                return ['error' => 'O campo de consumo é obrigatório.'];
            }
        }

    }

}