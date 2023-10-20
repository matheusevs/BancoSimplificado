<?php 
$UserController = new UserController();
$TransactionController = new TransactionController();
$user = mysqli_fetch_array($UserController->validateToken($_COOKIE['Authorization']), MYSQLI_ASSOC);
$userWallet = $TransactionController->getBankAccount($user['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transferência Bancária</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link type="text/css" rel="stylesheet" href="/src/assets/css/normalize.css">
    <link type="text/css" rel="stylesheet" href="/src/assets/css/transferencia.css">
</head>
<body>
    <div class="overlay">
        <div class="loading-spinner">
            <div class="spinner"></div>
        </div>
    </div>

    <div class="container">
        <a href="/" class="btn btn-back">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
        <h1 class="my-4">Transferência Bancária</h1>
        <div class="row">
            <div class="col-md-6">
                <form id="formTransaction">
                    <div class="form-group">
                        <label for="destino">Conta de Destino</label>
                        <input type="text" class="form-control" id="destino" name="destino" placeholder="Número da conta de destino" required>
                    </div>
                    <div class="form-group">
                        <label for="valor">Valor da Transferência</label>
                        <input type="text" class="form-control" id="valor" name="valor" placeholder="Valor em reais" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btn-transaction-confirm" data-id="<?php echo $userWallet['idConta'] ?>">Transferir</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Adicione os links para os arquivos JavaScript do Bootstrap e do jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="/src/assets/js/transferencia.js"></script>
</body>
</html>
