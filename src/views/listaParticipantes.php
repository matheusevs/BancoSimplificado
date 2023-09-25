<?php 
    $ParticipanteController = new ParticipanteController();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link type="text/css" rel="stylesheet" href="/src/views/css/normalize.css">
        <link type="text/css" rel="stylesheet" href="/src/views/css/estilo.css">
    </head>
    <body id="fundo">
        <section id="home">
            <div id="caixa_formulario" class="container">
                <a href="/" class="btn btn-back">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
                <div class="row">
                    <h1 class="display-4 text-center col">EVENTO</h1>
                </div>

                <div class="row justify-content-center">
                    <h1 class="display-4 text-center">Lista de participantes</h1>
                    <table id="tabela" class="table table-bordereds justify-content-center">
                        <thead>
                            <tr class="cabecalho_table">
                                <th>#</th>
                                <th>Nome</th>
                                <th>Quantidade que pretende consumir</th>
                                <th>Última atualização</th>
                                <th>Ações</th>
                            </tr>
                            <tbody class="table table-bordereds justify-content-center">
                            <?php 
                                $participantes = $ParticipanteController->getParticipantes();
                               
                                if(!$participantes['error']){
                                    foreach($participantes as $key => $value){
    
                                        $dateTime = new DateTime($value['hora_registro']);
                                        $dataFormatada = $dateTime->format("d/m/Y H:i:s");
    
                                        if($value['hora_update']){
                                            $dateTime = new DateTime($value['hora_update']);
                                            $dataFormatada = $dateTime->format("d/m/Y H:i:s");
                                        }
    
                                        echo '
                                            <tr>
                                                <th>' .$value['id']. '</th>
                                                <th>' .$value['nome']. '</th>
                                                <th>' .$value['consumo']. '</th>
                                                <th>' .$dataFormatada. '</th>
                                                <td>
                                                    <button class="btn btn-primary btn-edit" style="display: inline;" value="' .$value['id'] .'"  data-bs-toggle="modal" data-bs-target="#editarParticipanteModal"> <i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-danger btn-delete" style="display: inline;" value="' .$value['id'] .'"  data-bs-toggle="modal" data-bs-target="#confirm-delete"><i class="fas fa-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                        ';
                                    }
                                }
                            ?>
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="editarParticipanteModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ModalLabel">Editar participante</h1>
                        </div>
                        <form id="formEdit">
                            <input type="hidden" id="id" name="id"/>
                            <div class="modal-body">
                                <div>
                                    <div class="mb-3">
                                        <label for="nome">Nome</label>
                                        <input required="required" class="form-control" type="text" id="nomeEdit" placeholder="Digite seu nome" name="nomeTextEdit" maxlength="255">
                                    </div>
                                    <div class="mb-3">
                                        <label for="qtdConsumo">Digite o kg ou litros que irá consumir</label>
                                        <input required="required" class="form-control" type="number" id="qtdConsumoEdit" placeholder="Digite o kg ou litros que ira consumir" name="consumoNumberEdit">
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
                        </div>
                        <div class="modal-body">
                            Tem certeza que deseja excluir esse item?
                        </div>
                        <div class="modal-footer">
                        <form id="formDelete" style="display: inline;">
                            <input type="hidden" id="id" name="id"/>
                            <button type="button" id="fecharDeletar" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button id="delete" type="submit" id="btn-confirm-delete" class="btn btn-danger">Excluir</a>
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
        <script src="/src/views/js/participantes.js"></script>
    </body>
</html>