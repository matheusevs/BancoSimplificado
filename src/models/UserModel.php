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
                INSERT INTO users (full_name, cpf_cnpj, email, password, user_type)
                VALUES ('{$user['nome']}', '{$user['cpfcnpj']}', '{$user['email']}', sha1('{$user['senha']}'), '{$user['usertype']}');
            ";

            $createUser = mysqli_query($this->connect, $sql);
            if(!$createUser){
                return ['error' => mysqli_error($this->connect)];
            }
            
            return mysqli_insert_id($this->connect);

        }

        public function insertUserWallet($userId){

            $sql = "
                INSERT INTO user_wallet (user_id) VALUES ({$userId});
            ";

            $createWallet = mysqli_query($this->connect, $sql);
            if(!$createWallet){
                return ['error' => mysqli_error($this->connect)];
            }
            
            return $createWallet;

        }

        public function findUser($body = null, $where = null){

            if($body && !$where){
                $where = "email = '{$body['email']}' OR cpf_cnpj = '{$body['cpfcnpj']}'";
            }

            $sql = "
                SELECT
                    *
                FROM
                    users
                WHERE
                    $where;
            ";

            $findUser = mysqli_query($this->connect, $sql);
            if(!$findUser){
                return ['error' => mysqli_error($this->connect)];
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
                    id, full_name, cpf_cnpj, email, user_type
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
                return ['error' => mysqli_error($this->connect)];
            }

            return $userDelete;

        }

        public function updatePassword($id, $passwordCurrent, $passwordNew){

            $date = date('Y-m-d H:i:s');

            $sql = "
                UPDATE users
                SET password = sha1('{$passwordNew}'), update_time = '{$date}'
                WHERE id = {$id} AND password = sha1('{$passwordCurrent}');
            ";

            $updatePassword = mysqli_query($this->connect, $sql);
            if(!$updatePassword){
                return ['error' => mysqli_error($this->connect)];
            }

            return $updatePassword;
        }

        public function registerLogUser($user_id, $action, $obs){

            $sql = "
                INSERT INTO users_logs (user_id, action, obs)
                VALUES ({$user_id}, '{$action}', '{$obs}');
            ";

            $createLog = mysqli_query($this->connect, $sql);
            if(!$createLog){
                return ['error' => mysqli_error($this->connect)];
            }
            
            return $createLog;

        }

        public function getLogsUsers(){

            $arrLogs = [];

            $sql = "
                SELECT 
                    ul.id, u.full_name, action, obs, ul.registration_time, ul.update_time
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
                $where = " AND user_type = 'admin'";
            }

            $sql = "
                SELECT 
                    *
                FROM 
                    users
                WHERE 
                    id = $user->id
                    AND cpf_cnpj = '$user->cpf_cnpj'
                    AND email = '$user->email'
                    AND password = '$user->password'
                    $where;
            ";

            $user = mysqli_query($this->connect, $sql);
            if(!$user){
                return ['error' => mysqli_error($this->connect)];
            }

            return $user;

        }

    }