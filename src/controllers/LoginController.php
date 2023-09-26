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

}