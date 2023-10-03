<?php 
$UserController = new UserController();
$user = mysqli_fetch_array($UserController->validateToken($_COOKIE['Authorization']), MYSQLI_ASSOC);
$roles = 'Participante';
if($user['roles'] == 'admin'){
    $roles = 'Administrador';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="/src/views/css/normalize.css">
    <link type="text/css" rel="stylesheet" href="/src/views/css/estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>Dados do Usuário</title>
</head>
<body>

    <a href="/" class="btn btn-back">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
    <div class="container-user">
        <h1 id="dados-usuario">Dados do Usuário</h1>
        <div class="user-info">
            <div class="user-avatar">
                <img src="src/assets/avatar.jpg" alt="Foto de Perfil">
            </div>
            <div class="user-name"><?php echo $user['name']; ?></div>
            <div class="user-email"><?php echo $user['email']; ?></div>
            <div class="user-roles"><?php echo $roles; ?></div>
        </div>
    </div>
</body>
</html>
