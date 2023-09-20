<?php 

define('RELATIVE_PATH', dirname(__FILE__));
require_once('./src/routes/Routes.php');
$router = new Router();

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="./src/views/css/normalize.css">
        <link rel="stylesheet" type="text/css" href="./src/views/css/estilo.css">
        <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    </head>
    <body id="fundo">
        <section id="home">
            <div id="caixa_formulario" class="container pt-5 pb-5">
                <div class="row">
                    <h1 class="display-4 text-center col">EVENTO</h1>
                </div>

                <div class="display-4 text-center col">
                    <input class="btn btn-custom btn-branco" type="submit" onclick="location.href='/src/views/item.php'" value="Cadastrar Itens"/>
                    <input class="btn btn-custom btn-branco" type="submit" onclick="location.href='/src/views/participantes.php'" value="Cadastrar Participantes"/>
                </div>
            </div>
        </section>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
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