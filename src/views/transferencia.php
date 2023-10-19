<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transferência Bancária</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="/src/assets/css/normalize.css">
    <link type="text/css" rel="stylesheet" href="/src/assets/css/transferencia.css">
</head>
<body>
    <div class="container">
        <a href="/" class="btn btn-back">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
        <h1 class="my-4">Transferência Bancária</h1>
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="form-group">
                        <label for="origem">Conta de Origem</label>
                        <input type="text" class="form-control" id="origem" placeholder="Número da conta de origem">
                    </div>
                    <div class="form-group">
                        <label for="destino">Conta de Destino</label>
                        <input type="text" class="form-control" id="destino" placeholder="Número da conta de destino">
                    </div>
                    <div class="form-group">
                        <label for="valor">Valor da Transferência</label>
                        <input type="text" class="form-control" id="valor" placeholder="Valor em reais">
                    </div>
                    <button type="submit" class="btn btn-primary">Transferir</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Adicione os links para os arquivos JavaScript do Bootstrap e do jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
