<?php

    require_once(RELATIVE_PATH . '/src/models/UserModel.php');

    class UserController
    {

        public $userModel;

        public function __construct()
        {

            $this->userModel = new UserModel();
            
        }

        public function insertUser($body, $type = null, $token = null){

            $validateFields = $this->validateFields($body, $type);
            if($validateFields['error']){
                return $validateFields;
            }

            $userModel = new UserModel();

            $findUser = $userModel->findUser($body['email']);
            if($findUser['error']){
                return $findUser;
            }

            if(!$userModel->insert($body)){
                return ['error' => 'Não foi possível criar o novo usuário.'];
            }

            if($token){
                $objUser = $this->convertToken($token);
                if(!$this->userModel->registerLogUser($objUser->id, "cadastrarUsuario", "Usuário {$body['email']} criado.")){
                    return ['message' => 'Usuário criado com sucesso, contudo, ocorreu um erro na criação do log.'];
                }
            }

            return ['message' => 'Usuário criado com sucesso'];

        }

        public function updateUser($body, $id, $type = null, $token = null){

            $validateFields = $this->validateFields($body, $type);
            if($validateFields['error']){
                return $validateFields;
            }

            $set = $this->mountSet($validateFields);

            if(!$this->userModel->update($set, $id)){
                return ['error' => 'Não foi possível editar o usuário.'];
            }

            if($token){
                $objUser = $this->convertToken($token);
                if(!$this->userModel->registerLogUser($objUser->id, "editarUsuario", "Usuário {$body['email']} atualizado.")){
                    return ['message' => 'Usuário atualizado com sucesso, contudo, ocorreu um erro na criação do log.'];
                }
            }

            return ['message' => 'Usuário atualizado com sucesso.'];

        }

        public function deleteUser($id, $token){

            if(empty($id)){
                return ['error' => 'Id não informado'];
            }

            $objUser = $this->convertToken($token);
            if($id == $objUser->id){
                return ['error' => 'Você não pode estar logado para apagar seu usuário!'];
            }

            $getUserById = $this->getUserById($id);
            if(!$getUserById){
                return ['error' => 'Usuário não existe na base da dados.'];
            }
    
            if(!$this->userModel->delete($id)){
                return ['error' => 'Não foi possível deletar o usuário.'];
            }

            if($token){
                $objUser = $this->convertToken($token);
                if(!$this->userModel->registerLogUser($objUser->id, "deletarUsuario", "Usuário {$getUserById['email']} deletado.")){
                    return ['message' => 'Usuário atualizado com sucesso, contudo, ocorreu um erro na criação do log.'];
                }
            }

            return ['message' => 'Usuário deletado com sucesso.'];

        }

        public function getUsers(){

            return $this->userModel->getUsers();

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

        public function convertToken($token){

            $user = base64_decode($token, true);
            $user = unserialize($user);
            return json_decode(json_encode($user), false);

        }

        public function validateToken($token, $haveAdmin = null){
            
            if(empty($token)){
                return ['error' => 'Não foi recebido nenhum token.'];
            }

            $objUser = $this->convertToken($token);
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