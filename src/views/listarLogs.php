<?php 
$UserController = new UserController();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link type="text/css" rel="stylesheet" href="/src/assets/css/normalize.css">
    <link type="text/css" rel="stylesheet" href="/src/assets/css/estilo.css">
</head>
<body id="fundo">
    
    <a href="/" class="btn btn-back">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>

    <section id="home">
        <div id="caixa_formulario" class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h1 class="display-4 text-center">Lista de logs</h1>
                    <table id="tabela" class="table table-bordereds justify-content-center">
                        <thead>
                            <tr class="cabecalho_table">
                                <th>#</th>
                                <th>Usuário que realizou a ação</th>
                                <th>Ação/Rota</th>
                                <th>Observação</th>
                                <th>Última atualização</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $usersLogs = $UserController->getLogsUsers();
                            if (!$usersLogs['error']) {
                                foreach ($usersLogs as $key => $value) {
                                    $dateTime = new DateTime($value['registration_time']);
                                    $dataFormatada = $dateTime->format("d/m/Y H:i:s");

                                    if($value['update_time']){
                                        $dateTime = new DateTime($value['update_time']);
                                        $dataFormatada = $dateTime->format("d/m/Y H:i:s");
                                    }

                                    echo '
                                    <tr>
                                        <th>' .$value['id']. '</th>
                                        <th>' .$value['full_name']. '</th>
                                        <th>' .$value['action']. '</th>
                                        <th>' .$value['obs']. '</th>
                                        <th>' .$dataFormatada. '</th>
                                    </tr>
                                    ';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <script src="/src/assets/js/usuarios.js"></script>
</body>
</html>
