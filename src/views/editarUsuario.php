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
    <link type="text/css" rel="stylesheet" href="/src/assets/css/normalize.css">
    <link type="text/css" rel="stylesheet" href="/src/assets/css/estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>Dados do Usuário</title>
</head>
<body id="fundo">

    <a href="/" class="btn btn-back">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
    <div class="container-user">
        <h1 id="dados-usuario">Dados do Usuário</h1>
        <div class="user-info">
            <div class="user-avatar">
                <img src="src/assets/img/avatar.jpg" alt="Foto de Perfil">
            </div>
            <div class="user-name">
                <span id="name"><?php echo $user['name']; ?></span>
            </div>
            <div class="user-email">
                <span id="email"><?php echo $user['email']; ?></span>
            </div>
            <div class="user-roles">
                <span id="roles"><?php echo $roles; ?></span>
            </div>
        </div>
        <div id="botoes">
            <button class="btn-edit" value="<?php echo $user['id']; ?>" data-bs-toggle="modal" data-bs-target="#editarUsuarioModal"><i class="fas fa-pencil-alt"></i> Editar</button>
            <button class="btn-delete"><i class="fas fa-trash-alt"></i> Deletar</button>
        </div>
    </div>

    <div class="modal fade" id="editarUsuarioModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">Editar usuário</h1>
                </div>
                <form id="formEdit">
                    <input type="hidden" id="id" name="id"/>
                    <div class="modal-body">
                        <p><strong>Atenção:</strong> Ao alterar seu usuário, você será automaticamente desconectado e precisará fazer login novamente.</p>
                        <div>
                            <div class="mb-3">
                                <label for="usuario">Usuario</label>
                                <input required="required" class="form-control" type="text" id="nomeEdit" placeholder="Digite o nome do usuário" name="name" maxlength="255">
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input required="required" class="form-control" type="email" id="emailEdit" placeholder="Digite o email do usuário" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="fecharEditar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button id="save" type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<script src="/src/assets/js/editarUsuario.js"></script>