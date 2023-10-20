<?php 
$UserController = new UserController();
$TransactionController = new TransactionController();
$user = mysqli_fetch_array($UserController->validateToken($_COOKIE['Authorization']), MYSQLI_ASSOC);
$userWallet = $TransactionController->getBankAccount($user['id']);
if(isset($userWallet['error'])){
    header('Location: /');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extrato Bancário</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="/src/assets/css/normalize.css">
    <link type="text/css" rel="stylesheet" href="/src/assets/css/extrato.css">
</head>
<body>
    <a href="/" class="btn btn-back">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
    <div class="container">
        <header class="py-5 text-center">
            <h1>Extrato Bancário</h1>
            <p class="lead">Número da Conta: <?php echo $userWallet['idConta'] ?></p>
        </header>
        <main>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $getExtract = $TransactionController->getExtract($userWallet['idConta']);
                        if (!$getExtract['error']) {
                            foreach($getExtract as $key => $value){
                                $dateTime = new DateTime($value['registration_time']);
                                $dataFormatada = $dateTime->format("d/m/Y H:i:s");

                                if($value['update_time']){
                                    $dateTime = new DateTime($value['update_time']);
                                    $dataFormatada = $dateTime->format("d/m/Y H:i:s");
                                }

                                echo '
                                <tr>
                                    <td>' .$dataFormatada. '</td>
                                    <td>' .$value['tipo']. '</td>
                                    <td>R$ ' .$value['value']. '</td>
                                </tr>
                                ';
                            }
                        }
                    ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
