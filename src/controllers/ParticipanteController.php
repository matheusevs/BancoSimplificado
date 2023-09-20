<?php

require_once(RELATIVE_PATH . '/src/models/ParticipanteModel.php');

class ParticipanteController{

    public $ParticipanteModel;

    public function __construct()
    {
        
        $this->ParticipanteModel = new ParticipanteModel();

    }

    public static function saveParticipante($body){

        var_dump($body);


        if(empty($body)){
            return ['error' => 'O corpo da requisição não pode estar vazio.'];
        }

        if(!isset($body['nomeText']) || empty($body['nomeText'])){
            return ['error' => 'O campo de nome é obrigatório.'];
        }

        if(!isset($body['consumoNumber']) || empty($body['consumoNumber']) || !is_numeric($body['consumoNumber'])){
            return ['error' => 'O campo de consumo é obrigatório.'];
        }

        $ParticipanteModel = new ParticipanteModel();
        if(!$ParticipanteModel->createParticipante($body)){
            return ['error' => 'Não foi possível cadastrar um participante.'];
        }

    }

}