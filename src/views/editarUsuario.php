<?php 
$UserController = new UserController();
$user = mysqli_fetch_array($UserController->validateToken($_COOKIE['Authorization']), MYSQLI_ASSOC);
$roles = 'Administrador';
if($user['user_type'] != 'admin'){
    $roles = ucfirst($user['user_type']);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
                <span id="name"><?php echo $user['full_name']; ?></span>
            </div>
            <div class="user-email">
                <span id="email"><?php echo $user['email']; ?></span>
            </div>
            <div class="user-roles">
                <span id="roles">Usuário <?php echo $roles; ?></span>
            </div>
        </div>
        <div id="botoes">
            <button class="btn-edit" value="<?php echo $user['id']; ?>" data-bs-toggle="modal" data-bs-target="#editarUsuarioModal"><i class="fas fa-pencil-alt"></i> Editar</button>
            <button class="btn-alterPassword" value="<?php echo $user['id']; ?>" data-bs-toggle="modal" data-bs-target="#alterarSenhaModal"><i class="fas fa-lock"></i> Alterar senha</button>
            <button class="btn btn-danger btn-delete" style="display: inline;" value="<?php echo $user['id'] ?>"  data-bs-toggle="modal" data-bs-target="#confirm-delete"><i class="fas fa-trash-alt"></i> Deletar</button>
        </div>
    </div>

    <div class="modal fade" id="editarUsuarioModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="ModalLabel">Editar usuário</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formEdit">
                    <input type="hidden" id="id" name="id"/>
                    <div class="modal-body">
                        <p><strong>Atenção:</strong> Ao alterar seu CPF/CNPJ ou e-mail, você será automaticamente desconectado e precisará fazer login novamente.</p>
                        <div>
                            <div class="mb-3">
                                <label for="usuario">Nome</label>
                                <input required="required" class="form-control" type="text" id="nomeEdit" placeholder="Digite o nome do usuário" name="full_name" maxlength="255">
                            </div>
                            <div class="mb-3">
                                <label for="cpfcnpj">CPF/CNPJ</label>
                                <input required="required" class="form-control" type="text" id="cpfCnpjEdit" placeholder="Digite o nome do usuário" name="cpf_cnpj">
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

    <div class="modal fade" id="alterarSenhaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Alterar Senha</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Atenção:</strong> Ao alterar sua senha, você será automaticamente desconectado e precisará fazer login novamente.</p>
                    <form id="formAlterarSenha">
                        <div class="form-group">
                            <label for="senhaAtual">Senha Atual</label>
                            <div class="password-container">
                                <input type="password" class="form-control" id="senhaAtual" name="passwordCurrent" required>
                                <span class="toggle-password toggleAlterPassword" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="novaSenha">Nova Senha</label>
                            <div class="password-container">
                                <input type="password" class="form-control" id="novaSenha" name="passwordNew" required>
                                <span class="toggle-password toggleAlterPassword" id="togglePasswordConfirm">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirmarSenha">Confirmar Nova Senha</label>
                            <input type="password" class="form-control" id="confirmarSenha" name="passwordNewConfirm" required>
                            <span class="error-message" id="password-error"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary" id="btnSalvarSenha">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Confirmação de exclusão</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja excluir seu usuário?
                </div>
                <div class="modal-footer">
                    <form id="formDelete" style="display: inline;">
                        <button type="button" id="fecharDeletar" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button id="btn-confirm-delete" class="btn btn-danger">Excluir</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="/src/assets/js/editarUsuario.js"></script>