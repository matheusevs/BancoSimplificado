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
                return ['error' => mysqli_error($this->connect)];
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
                return ['error' => mysqli_error($this->connect)];
            }

            return $findUser;

        }

        public function validateToken($user){

            $sql = "
                SELECT 
                    *
                FROM 
                    users
                WHERE 
                    id = $user->id
                    AND name = '$user->name'
                    AND email = '$user->email'
                    AND password = '$user->password';
            ";

            $user = mysqli_query($this->connect, $sql);
            if(!$user){
                return ['error' => mysqli_error($this->connect)];
            }

            return $user;

        }

    }