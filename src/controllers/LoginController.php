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

        try {

            $this->validateFields($body);
            $login = $this->LoginModel->login($body);
            
            if($login['error']){
                return $login;
            }
            
            return $this->encodeBase64($login);

        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }

        

    }

    public function encodeBase64($login){

        $base64 = base64_encode(serialize($login));

        $login['token'] = $base64;

        return $login;

    }

    public function validateFields($body){

        if(empty($body)){
            throw new Exception('O corpo da requisição não pode estar vazio.');
        }

        if(!isset($body['email']) || empty($body['email'])){
            throw new Exception('O campo de email é obrigatório.');
        }

        if (!filter_var($body['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception('O campo de email não está em um formato válido.');
        }

        if(!isset($body['password']) || empty($body['password'])){
            throw new Exception('O campo de senha é obrigatório.');
        }

    }

}