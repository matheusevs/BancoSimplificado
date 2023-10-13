<?php

    require_once(RELATIVE_PATH . '/ConnectDb.php');

    class UserModel{

        public $connect;

        public function __construct()
        {

            $con = new ConnectDb();
            $this->connect = $con->connection();

        }

        public function insert($user){

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
            if($findUser->num_rows > 0){
                return ['error' => 'O usuário já existe.'];
            }

            return mysqli_fetch_array($findUser, MYSQLI_ASSOC);

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
                return ['error' => 'Não foi encontrado nenhum usuário.'];
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

        public function update($set, $id){

            $sql = "
                UPDATE users
                SET {$set}
                WHERE id = {$id};
            ";

            $update = mysqli_query($this->connect, $sql);
            if(!$update){
                return ['error' => mysqli_error($this->connect)];
            }

            return $update;
        }

        public function delete($id){

            $sql = "DELETE FROM users WHERE id = {$id}";

            $userDelete = mysqli_query($this->connect, $sql);
            if(!$userDelete){
                return ['error' => mysqli_connect_error()];
            }

            return $userDelete;

        }

        public function registerLogUser($user_id, $action, $obs){

            $sql = "
                INSERT INTO users_logs (user_id, action, obs)
                VALUES ({$user_id}, '{$action}', '{$obs}');
            ";

            $createLog = mysqli_query($this->connect, $sql);
            if(!$createLog){
                return ['error' => mysqli_connect_error()];
            }
            
            return $createLog;

        }

        public function getLogsUsers(){

            $arrLogs = [];

            $sql = "
                SELECT 
                    ul.id, u.name, action, obs, ul.hora_registro, ul.hora_update
                FROM 
                    users_logs ul
                INNER JOIN 
                    users u ON ul.user_id = u.id;
            ";

            $getLogs = mysqli_query($this->connect, $sql);
            if(!$getLogs){
                return ['error' => mysqli_error($this->connect)];
            }
            if($getLogs->num_rows == 0){
                return ['error' => 'Não foi encontrado nenhum log registrado.'];
            }

            while($row = mysqli_fetch_array($getLogs, MYSQLI_ASSOC)){
      
                array_push($arrLogs, $row);
            
            }

            return $arrLogs;

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