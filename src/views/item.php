<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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
                    <form id="formularioItens" method="POST" action="/cadastrarItens">
                        <h1 class="display-4 text-center col">LISTA DE DESEJOS</h1>
                        <div class="form-group input-group">
                            <label for="item"></label>
                            <input required="required" class="form-control" type="text" id="item" placeholder="Digite seu item" name="itemText" maxlength="255">
                        </div>
                        <div class="form-group input-group">
                            <label for="qtdItem"></label>
                            <input required="required" class="form-control" type="number" id="qtdItem" placeholder="Digite o kg ou litros do item" name="qtdItemNumber">
                        </div>
                        <div id="botoes">
                            <button id="botao" class="btn btn-custom btn-branco" type="submit" value="Salvar">SALVAR</button>
                        </div>        
                    </form>
                </div>
            </div>
        </section>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    </body>
</html>