<?php

require_once(RELATIVE_PATH . '/ConnectDb.php');

class LoginModel
{

    public $connect;

    public function __construct()
    {

        $con = new ConnectDb();
        $this->connect = $con->connection();

    }

    public function login($user){

        $sql = "
            SELECT 
                *
            FROM 
                users
            WHERE 
                email = '{$user['email']}'
                AND password = sha1('{$user['password']}');
        ";

        $loginUser = mysqli_query($this->connect, $sql);
        if(!$loginUser){
            return ['error' => mysqli_connect_error()];
        }
        if($loginUser->num_rows == 0){
            return ['error' => 'O usuário não existe ou a senha é inválida'];
        }
        
        return mysqli_fetch_array($loginUser, MYSQLI_ASSOC);

    }

}