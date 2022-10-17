<?php 

$user = 'root';
$pass = 'versa@123';
$db = new PDO('mysql:host=localhost;dbname=OSI8', $user, $pass);

$sql = "SELECT * FROM itens";
$result = $db->query($sql);
$rows = $result->fetchAll();


if($rows <= 20){
    if(!empty($_POST['itemText']) && !empty($_POST['qtdItemText'])){
        $itemText = $_POST["itemText"];
        $qtdItemText = $_POST["qtdItemText"];
        $sql = "INSERT INTO itens(item, qtdItem) VALUES(:item, :qtdItem)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam( ':item', $itemText );
        $stmt->bindParam( ':qtdItem', $qtdItemText );
        
        $result = $stmt->execute();
        
        if ( ! $result )
        {
            var_dump( $stmt->errorInfo() );
            exit;
        }
    
        echo $stmt->rowCount() . "linhas inseridas";
    }
}

?>