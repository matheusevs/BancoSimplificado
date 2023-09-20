<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>Erro</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="/src/views/css/error.css">
</head>
<body>

<?php
    $motivoErro = $_GET['motivoErro'];

    if($motivoErro == 'acessoBanco'){
        $mensagem = 'Ocorreu um erro ao acessar o banco de dados, solicite suporte!';
    }

    if($motivoErro == 'database'){
        $mensagem = 'Não foi possível encontrar a base de dados, verifique se a mesma foi criada!';
    }

    if($motivoErro == 'semRegistros'){
        $mensagem = 'Não existem registros no banco, verifique e tente novamente!';
    }

?>

<body class="bg-purple">
        <div class="stars">
            <div class="central-body">
                <h1>Ocorreu um erro!</h1>
                <h2> 
                    <?php echo $mensagem ?>
                </h2>
                <a href="../../index.php" class="btn-go-home" target="_blank">VOLTAR</a>
            </div>
            <div class="objects">
                <img class="object_rocket" src="http://salehriaz.com/404Page/img/rocket.svg" width="40px">
                <div class="earth-moon">
                    <img class="object_earth" src="http://salehriaz.com/404Page/img/earth.svg" width="100px">
                    <img class="object_moon" src="http://salehriaz.com/404Page/img/moon.svg" width="80px">
                </div>
                <div class="box_astronaut">
                    <img class="object_astronaut" src="http://salehriaz.com/404Page/img/astronaut.svg" width="140px">
                </div>
            </div>
            <div class="glowing_stars">
                <div class="star"></div>
                <div class="star"></div>
                <div class="star"></div>
                <div class="star"></div>
                <div class="star"></div>

            </div>

        </div>

    </body>
<!-- partial -->
</body>
</html>