<?php 

$user = 'root';
$pass = '';
$db = new PDO('mysql:host=localhost;dbname=OSI8', $user, $pass);

$sql = "SELECT * FROM itens";
$result = $db->query($sql);
$rows = $result->fetchAll();


if(count($rows) <= 20){
    if(!empty($_POST['itemText']) && !empty($_POST['qtdItemNumber'])){
        $itemText = $_POST["itemText"];
        $qtdItemNumber = $_POST["qtdItemNumber"];
        $sql = "INSERT INTO itens(item, qtdItem) VALUES(:item, :qtdItem)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam( ':item', $itemText );
        $stmt->bindParam( ':qtdItem', $qtdItemNumber );
        
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