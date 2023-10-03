<?php 
error_reporting(E_ALL & ~E_NOTICE);

date_default_timezone_set('America/Sao_Paulo');
define('RELATIVE_PATH', dirname(__FILE__));
require_once('./src/routes/Routes.php');
$router = new Router();
$user = mysqli_fetch_array($router->validateToken(), MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="/src/views/css/normalize.css">
    <link type="text/css" rel="stylesheet" href="/src/views/css/estilo.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <title>Página de Administração</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">UserHub</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span class="nav-link">Seja bem-vindo, <?php echo $user['name'];?></span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="" id="logoutButton">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="overlay">
    <div class="loading-spinner">
        <div class="spinner"></div>
    </div>
</div>

<div class="container mt-5">

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                <h5 class="card-title">Editar meu usuário</h5>
                <p class="card-text">Clique abaixo para editar seu usuário.</p>
                <form method="GET" action="/editarMeuUsuario">
                    <button id="botao" class="btn btn-primary" type="submit">Editar Usuário</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    
    <?php if($user['roles'] == 'admin'){ ?>
        
        <h1 class="text-center mb-4">Página de Administração</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Cadastrar Usuários</h5>
                        <p class="card-text">Clique abaixo para cadastrar novos usuários.</p>
                        <form method="GET" action="/cadastrarUsuarios">
                            <button id="botao" class="btn btn-primary" type="submit">Cadastrar Usuários</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Listar Usuários</h5>
                        <p class="card-text">Clique abaixo para listar, editar ou excluir usuários existentes.</p>
                        <form method="GET" action="/listarUsuarios">
                            <button id="botao" class="btn btn-primary" type="submit">Listar Usuários</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Listar logs</h5>
                        <p class="card-text">Clique abaixo para listar os logs existentes.</p>
                        <form method="GET" action="/listarLogs">
                            <button id="botao" class="btn btn-primary" type="submit">Listar Logs</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    <?php } ?>
</div>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirmar Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza de que deseja sair da sua conta?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a href="" id="logout" class="btn btn-primary">Sair</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="/src/views/js/login.js"></script>
</body>
</html>

<script>
    jQuery(document).ready(function(){
        var msg = window.location.href;

        if(msg.includes('success')){
            toastr.success('Cadastrado realizado com sucesso!');
            return;
        }
        if(msg.includes('error')){
            toastr.error('Erro ao cadastrar!');
            return;
        }
    })
</script>
