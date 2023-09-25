<?php 
date_default_timezone_set('America/Sao_Paulo');
define('RELATIVE_PATH', dirname(__FILE__));
require_once('./src/routes/Routes.php');
$router = new Router();
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

<div class="container mt-5">
    <h1 class="text-center mb-4">Página de Administração</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Cadastrar Itens</h5>
                    <p class="card-text">Clique abaixo para cadastrar novos itens.</p>
                    <form method="GET" action="/item">
                        <button id="botao" class="btn btn-primary" type="submit">Cadastrar Itens</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Cadastrar Participantes</h5>
                    <p class="card-text">Clique abaixo para cadastrar novos participantes.</p>
                    <form method="GET" action="/participantes">
                        <button id="botao" class="btn btn-primary" type="submit">Cadastrar Participantes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Listar Itens</h5>
                    <p class="card-text">Clique abaixo para listar, editar ou excluir itens existentes.</p>
                    <form method="GET" action="/listaItens">
                        <button id="botao" class="btn btn-primary" type="submit">Listar Itens</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Listar Participantes</h5>
                    <p class="card-text">Clique abaixo para listar, editar ou excluir participantes existentes.</p>
                    <form method="GET" action="/listaParticipantes">
                        <button id="botao" class="btn btn-primary" type="submit">Listar participantes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>
</html>

<script>
    jQuery(document).ready(function(){
        var msg = window.location.href;

        if(msg.includes('warning')){
            toastr.warning('Número de cadastrados atingido!');
            return
        }
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
