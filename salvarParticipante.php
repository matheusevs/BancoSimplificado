<?php 

$user = 'root';
$pass = '';
$db = new PDO('mysql:host=localhost;dbname=OSI8', $user, $pass);

$sql = "SELECT * FROM participantes";
$result = $db->query($sql);
$rows = $result->fetchAll();


if(count($rows) <= 30){
    if(!empty($_POST['nomeText']) && !empty($_POST['consumoNumber'])){
        $nomeText = $_POST["nomeText"];
        $consumoNumber = $_POST["consumoNumber"];
        $sql = "INSERT INTO participantes(nome, consumo) VALUES(:nome, :consumo)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam( ':nome', $nomeText );
        $stmt->bindParam( ':consumo', $consumoNumber );
        
        $result = $stmt->execute();
        
        if (!$result){
            header('Location: /osi8?msg=error');
            exit;
        }

        header('Location: /osi8?msg=success');
        exit;
    }
} else {
    header('Location: /osi8?msg=warning');
    exit;
}

?>