<?php

require_once(RELATIVE_PATH . '/ConnectDb.php');

class ParticipanteModel{

    public $connect;

    public function __construct()
    {

        $con = new ConnectDb();
        $this->connect = $con->connection();

    }

    public function createParticipante($data){

        $sql = "
            INSERT INTO participantes(nome, consumo) VALUES ('{$data['nomeText']}', {$data['consumoNumber']});
        ";

        $participanteCreate = mysqli_query($this->connect, $sql);
        if(!$participanteCreate){
            return ['error' => mysqli_error($this->connect)];
        }
        
        return $participanteCreate;

    }

}