<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="normalize.css">
        <link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
    <body id="fundo">
        <section id="home">
            <div id="caixa_formulario" class="container pt-5 pb-5">
                <div class="row">
                    <h1 class="display-4 text-center col">CHURRASCO DA KELLE</h1>
                </div>

                <div class="row justify-content-center">
                    <h1 class="display-4 text-center">CONSUMO NO CHURRASCO</h1>
                    <table id="tabela" class="table table-bordereds justify-content-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Quantidade que pretende consumir</th>
                            </tr>
                            <tbody class="table table-bordereds justify-content-center">
                            <?php 
                                $user = 'root';
                                $pass = '';
                                $db = new PDO('mysql:host=localhost;dbname=OSI8', $user, $pass);
                                
                                $sqlParticipantes = "SELECT * FROM participantes";
                                $sqlItens = "SELECT (SELECT SUM(qtdItem) FROM itens) as soma,itens.* FROM itens";
                                
                                $resultItens = $db->query($sqlItens);
                                $rowsItens = $resultItens->fetchAll();
                                
                                $resultParticipantes = $db->query($sqlParticipantes);
                                $rowsParticipantes = $resultParticipantes->fetchAll();
                                
                                foreach($rowsParticipantes as $key => $value){
                                    $consumoMedia = 0;
                                    $consumoMedia = $rowsItens[0]['soma']/$value['consumo'];
                                    echo '
                                        <tr>
                                            <th>' .$key. '</th>
                                            <td>' .$value['nome']. '</td>
                                            <td>' .$consumoMedia. '</td>
                                        </tr>
                                    ';
                                }
                            ?>
                            </tbody>
                        </thead>
                    </table>
                </div>

                <div class="row justify-content-center">
                    <h1 class="display-4 text-center">LISTA DOS PRODUTOS</h1>
                    <table id="tabela" class="table table-bordereds justify-content-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Produto</th>
                                <th>Quantidade a ser comprada</th>
                            </tr>
                            <tbody class="table table-bordereds justify-content-center">
                            <?php 
                               
                                
                                foreach($rowsItens as $key => $value){
                                    echo '
                                        <tr>
                                            <th>' .$key. '</th>
                                            <td>' .$value['item']. '</td>
                                            <td>' .$value['qtdItem']. '</td>
                                        </tr>
                                    ';
                                }
                            ?>
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </section>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    </body>
</html>