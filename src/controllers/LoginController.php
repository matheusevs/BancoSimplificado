<?php

require_once(RELATIVE_PATH . '/src/models/LoginModel.php');

class LoginController
{

    public $LoginModel;

    public function __construct()
    {
        
        $this->LoginModel = new LoginModel();

    }

    public function login($body){

        $validateFields = $this->validateFields($body);
        if($validateFields['error']){
            return $validateFields;
        }

        $login = $this->LoginModel->login($body);
        
        if($login['error']){
            return $login;
        }
        
        return $this->encodeBase64($login);

    }

    public function encodeBase64($login){

        $base64 = base64_encode(serialize($login));

        $login['token'] = $base64;

        return $login;

    }

    public function validateFields($body){

        if(empty($body)){
            return ['error' => 'O corpo da requisição não pode estar vazio.'];
        }

        if(!isset($body['email']) || empty($body['email'])){
            return ['error' => 'O campo de email é obrigatório.'];
        }

        if (!filter_var($body['email'], FILTER_VALIDATE_EMAIL)) {
            return ['error' => 'O campo de email não está em um formato válido.'];
        }

        if(!isset($body['password']) || empty($body['password'])){
            return ['error' => 'O campo de senha é obrigatório.'];
        }

    }

}