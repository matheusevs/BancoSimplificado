<?php

    require_once(RELATIVE_PATH . '/ConnectDb.php');

    class UserModel{

        public $connect;

        public function __construct()
        {

            $con = new ConnectDb();
            $this->connect = $con->connection();

        }

        public function createNewUser($user){

            $sql = "
                INSERT INTO users (name, email, password)
                VALUES ('{$user['nome']}', '{$user['email']}', sha1('{$user['senha']}'));
            ";

            $createUser = mysqli_query($this->connect, $sql);
            if(!$createUser){
                return ['error' => mysqli_connect_error()];
            }
            
            return $createUser;

        }

        public function findUser($email){

            $sql = "
                SELECT
                    *
                FROM
                    users
                WHERE
                    email = '$email';
            ";

            $findUser = mysqli_query($this->connect, $sql);
            if(!$findUser){
                return ['error' => mysqli_connect_error()];
            }

            return $findUser;

        }

        public function getUsers(){
            $arrayUsers = [];

            $sql = "
                SELECT
                    *
                FROM
                    users;
            ";

            $getUsers = mysqli_query($this->connect, $sql);
            if(!$getUsers){
                return ['error' => mysqli_error($this->connect)];
            }
            if($getUsers->num_rows == 0){
                return ['error' => 'Não foi nenhum usuário.'];
            }

            while($row = mysqli_fetch_array($getUsers, MYSQLI_ASSOC)){
      
                array_push($arrayUsers, $row);
            
            }

            return $arrayUsers;

        }

        public function findUserById($id){

            $sql = "
                SELECT
                    id, name, email, roles
                FROM
                    users
                WHERE 
                    id = $id;
            ";

            $findUser = mysqli_query($this->connect, $sql);
            if(!$findUser){
                return ['error' => mysqli_error($this->connect)];
            }
            if($findUser->num_rows == 0){
                return ['error' => 'Não foi identificado nenhum usuário com o id informado'];
            }

            return mysqli_fetch_array($findUser, MYSQLI_ASSOC);

        }

        public function updateUser($set, $id){

            $sql = "
                UPDATE users
                SET {$set}
                WHERE id = {$id};
            ";

            $updateUser = mysqli_query($this->connect, $sql);
            if(!$updateUser){
                return ['error' => mysqli_error($this->connect)];
            }

            return $updateUser;
        }

        public function validateToken($user, $haveAdmin = null){

            $where = '';
            if($haveAdmin){
                $where = " AND roles = 'admin'";
            }

            $sql = "
                SELECT 
                    *
                FROM 
                    users
                WHERE 
                    id = $user->id
                    AND name = '$user->name'
                    AND email = '$user->email'
                    AND password = '$user->password'
                    $where;
            ";

            $user = mysqli_query($this->connect, $sql);
            if(!$user){
                return ['error' => mysqli_connect_error()];
            }

            return $user;

        }

    }