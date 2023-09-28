<?php

    require_once(RELATIVE_PATH . '/src/models/UserModel.php');

    class UserController
    {

        public $userModel;

        public function __construct()
        {

            $this->userModel = new UserModel();
            
        }

        public function insertUser($body, $type = null){

            $validateFields = $this->validateFields($body, $type);
            if($validateFields['error']){
                return $validateFields;
            }

            $userModel = new UserModel();

            $findUser = $userModel->findUser($body['email']);
            if($findUser->num_rows > 0){
                return ['error' => 'O usuário já existe.'];
            }

            if(!$userModel->insert($body)){
                return ['error' => 'Não foi possível criar o novo usuário.'];
            }

            return ['message' => 'Usuário criado com sucesso'];

        }

        public function updateUser($body, $id, $type){

            $validateFields = $this->validateFields($body, $type);
            if($validateFields['error']){
                return $validateFields;
            }

            $set = $this->mountSet($validateFields);

            if(!$this->userModel->update($set, $id)){
                return ['error' => 'Não foi possível editar o usuário.'];
            }

        }

        public function deleteUser($id){

            if(empty($id)){
                return ['error' => 'Id não informado'];
            }
    
            if(!$this->userModel->delete($id)){
                return ['error' => 'Não foi possível deletar o participante.'];
            }

        }

        public function getUsers(){

            $getUsers = $this->userModel->getUsers();
            if($getUsers['error']){
                return $getUsers;
            }

            return $getUsers;

        }

        public function getUserById($id){

            if(empty($id) || !is_numeric($id) || intval($id) <= 0){
                return ['error' => 'O ID informado é inválido.'];
    	    }
            
            $findUser = $this->userModel->findUserById($id);
            return $findUser;

        }

        public function mountSet($set){

            $array = array();

            $set['hora_update'] = date('Y-m-d H:i:s');
            
            foreach ($set as $key => $value) {
                $array[] = "$key = '$value'";
            }
            
            $stringSet = implode(',', $array);
            return $stringSet;

        }

        public function validateToken($token, $haveAdmin = null){
            
            if(empty($token)){
                return ['error' => 'Não foi recebido nenhum token.'];
            }

            $user = base64_decode($token, true);
            $user = unserialize($user);
            $objUser = json_decode(json_encode($user), false);
            $userLogged = $this->userModel->validateToken($objUser, $haveAdmin);

            return $userLogged;
        }

        public function validateFields($body, $type = null){

            if($type == 'updateAdmin'){

                if(empty($body)){
                    return ['error' => 'O corpo da requisição não pode estar vazio.'];
                }

                if(!empty($body['id'])){
                    unset($body['id']);
                }

                if(empty($body['name'])){
                    unset($body['name']);
                }
    
                if(empty($body['email'])){
                    unset($body['email']);
                } else {
                    if (!filter_var($body['email'], FILTER_VALIDATE_EMAIL)) {
                        return ['error' => 'O campo de email não está em um formato válido.'];
                    }
                }

                if(empty($body['roles'])){
                    unset($body['roles']);
                }
    
                return $body;

            } else {
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
    
                if($type != 'createAdmin'){
                    if(!isset($body['confirmar_senha']) || empty($body['confirmar_senha'])){
                        return ['error' => 'O campo de confirmar senha é obrigatório.'];
                    }
        
                    if($body['senha'] != $body['confirmar_senha']){
                        return ['error' => 'Senhas não correspondem'];
                    }
                }
            }
        }
    }