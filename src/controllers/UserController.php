<?php

    require_once(RELATIVE_PATH . '/src/models/UserModel.php');

    class UserController
    {

        public $userModel;

        public function __construct()
        {

            $this->userModel = new UserModel();
            
        }

        public function saveUser($body){

            if(empty($body)){
                return ['error' => 'O corpo da requisição não pode estar vazio.'];
            }

            if(!isset($body['email']) || empty($body['email'])){
                return ['error' => 'O campo de email é obrigatório.'];
            }

            if (!filter_var($body['email'], FILTER_VALIDATE_EMAIL)) {
                return ['error' => 'O campo de email não está em um formato válido.'];
            }

            if(!isset($body['nome']) || empty($body['nome'])){
                return ['error' => 'O campo de nome é obrigatório.'];
            }

            if(!isset($body['senha']) || empty($body['senha'])){
                return ['error' => 'O campo de senha é obrigatório.'];
            }

            if(!isset($body['confirmar_senha']) || empty($body['confirmar_senha'])){
                return ['error' => 'O campo de confirmar senha é obrigatório.'];
            }

            $userModel = new UserModel();

            $findUser = $userModel->findUser($body['email']);
            if($findUser->num_rows > 0){
                return ['error' => 'O usuário já existe.'];
            }

            if(!$userModel->createNewUser($body)){
                return ['error' => 'Não foi possível criar o novo usuário.'];
            }

            return ['message' => 'Usuário criado com sucesso'];

        }

        public function validateToken($token){
            
            if(empty($token)){
                return ['error' => 'Não foi recebido nenhum token.'];
            }

            $token = explode('Bearer ', $token);
            $user = base64_decode($token[1], true);
            $user = unserialize($user);
            $objUser = json_decode(json_encode($user), false);
            $userLogged = $this->userModel->validateToken($objUser);

            return $userLogged;
        }

    }