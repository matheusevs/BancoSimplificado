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
                    <h1 class="display-4 text-center">Lista de usuários</h1>
                    <table id="tabela" class="table table-bordereds justify-content-center">
                        <thead>
                            <tr class="cabecalho_table">
                                <th>#</th>
                                <th>Nome</th>
                                <th>CPF/CNPJ</th>
                                <th>Email</th>
                                <th>Tipo Usuário</th>
                                <th>Última atualização</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $users = $UserController->getUsers();
                            if (!$users['error']) {
                                foreach ($users as $key => $value) {
                                    $dateTime = new DateTime($value['registration_time']);
                                    $dataFormatada = $dateTime->format("d/m/Y H:i:s");

                                    if($value['update_time']){
                                        $dateTime = new DateTime($value['update_time']);
                                        $dataFormatada = $dateTime->format("d/m/Y H:i:s");
                                    }

                                    $roles = 'Administrador';
                                    if($value['user_type'] != 'admin'){
                                        $roles = ucfirst($value['user_type']);
                                    }

                                    echo '
                                    <tr>
                                        <th>' .$value['id']. '</th>
                                        <th>' .$value['full_name']. '</th>
                                        <th>' .$value['cpf_cnpj']. '</th>
                                        <th>' .$value['email']. '</th>
                                        <th>' .$roles. '</th>
                                        <th>' .$dataFormatada. '</th>
                                        <td class="d-flex">
                                            <button class="btn btn-primary btn-edit mr-2" style="display: inline;" value="' .$value['id'] .'"  data-bs-toggle="modal" data-bs-target="#editarUsuarioModal"> <i class="fas fa-edit"></i></button>
                                            <button class="btn btn-danger btn-delete" style="display: inline;" value="' .$value['id'] .'"  data-bs-toggle="modal" data-bs-target="#confirm-delete"><i class="fas fa-trash-alt"></i></button>
                                        </td>
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
                            <div>
                                <div class="mb-3">
                                    <label for="usuario">Nome do Usuário</label>
                                    <input required="required" class="form-control" type="text" id="nomeEdit" placeholder="Digite o nome do usuário" name="full_name" maxlength="255">
                                </div>
                                <div class="mb-3">
                                    <label for="usuario">CPF/CNPJ</label>
                                    <input required="required" class="form-control" type="text" id="cpfCnpjEdit" placeholder="Digite o CPF/CNPJ do usuário" name="cpf_cnpj">
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input required="required" class="form-control" type="email" id="emailEdit" placeholder="Digite o email do usuário" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="user_type">Tipo Usuário</label>
                                    <select class="form-control" id="user_type" name="user_type">
                                        <option value="comum">Usuário Comum</option>
                                        <option value="lojista">Usuário Lojista</option>
                                        <option value="admin">Administrador</option>
                                    </select>
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
                        Tem certeza que deseja excluir esse usuário?
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
