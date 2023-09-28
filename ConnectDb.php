<?php

class ConnectDb{

    public $host;
    public $user;
    public $pass;
    public $data;


    public function __construct()
    {
        
        $this->host = 'localhost'; // host do seu banco de dados
        $this->user = 'root'; // user do seu banco de dados
        $this->pass = ''; // password do seu banco de dados
        $this->data = 'UserHub'; // nome do database, conforme criado em migration


    }

    public function connection(){

        $connection = mysqli_connect($this->host, $this->user, $this->pass, $this->data);
        if(!$connection){
            return ['error' => mysqli_connect_error()];
        }

        return $connection;

    }

}