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
    <title>Saldo Bancário</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="/src/assets/css/normalize.css">
    <link type="text/css" rel="stylesheet" href="/src/assets/css/saldo.css">
</head>
<body>
    <div class="container">
        <a href="/" class="btn btn-back">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
        <h1>Saldo Bancário</h1>
        <p>Número da Conta: <span class="account-number"><?php echo $userWallet['idConta'] ?></span></p>
        <p>Saldo Disponível:<span class="balance"> R$ <?php echo $userWallet['valorConta'] ?></span></p>
        <?php if($user['user_type'] == 'comum') { ?>
            <a href="/transferencia" class="btn btn-transferencia">Realizar Transferência</a>
        <?php } ?>
    </div>
</body>
</html>
