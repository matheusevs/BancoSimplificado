<?php

require_once(RELATIVE_PATH . '/src/models/ParticipanteModel.php');

class ParticipanteController{

    public $ParticipanteModel;

    public function __construct()
    {
        
        $this->ParticipanteModel = new ParticipanteModel();

    }

    public static function saveParticipante($body){

        $validateFields = $this->validateFields($body, 'create');
        if($validateFields['error']){
            return $validateFields;
        }

        $ParticipanteModel = new ParticipanteModel();
        if(!$ParticipanteModel->createParticipante($body)){
            return ['error' => 'Não foi possível cadastrar um participante.'];
        }

    }

    public function getParticipantes(){

        $getParticipantes = $this->ParticipanteModel->getParticipantes();
        return $getParticipantes;

    }

    public function getParticipanteById($id){

        $getParticipante = $this->ParticipanteModel->getParticipanteById($id);
        return $getParticipante;

    }

    public function updateParticipantesById($id, $data){
        
        if(empty($id)){
            return ['error' => 'Id não informado'];
        }

        $validateFields = $this->validateFields($data, 'edit');
        if($validateFields['error']){
            return $validateFields;
        }

        $data['hora_update'] = date('Y-m-d H:i:s');

        if(!$this->ParticipanteModel->updateParticipante($id, $data)){
            return ['error' => 'Não foi possível atualizar o participante.'];
        }
        
    }

    public function deleteParticipantesById($id){

        if(empty($id)){
            return ['error' => 'Id não informado'];
        }

        if(!$this->ParticipanteModel->deleteParticipantesById($id)){
            return ['error' => 'Não foi possível deletar o participante.'];
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