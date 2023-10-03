<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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
                <form id="formularioUsuario" method="POST" action="/cadastrarUsuario" class="col-md-6">
                    <h1 class="display-5 text-center mb-4">Cadastrar Usuário</h1>
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input required="required" class="form-control" type="text" id="nome" placeholder="Digite o nome" name="nome" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input required="required" class="form-control" type="email" id="email" placeholder="Digite o email" name="email" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input required="required" class="form-control" type="password" id="senha" placeholder="Digite a senha" name="senha" maxlength="255">
                        <span class="toggle-password" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    <div id="botoes" class="text-center">
                        <button id="botao" class="btn btn-primary" type="submit" value="Salvar">SALVAR</button>
                    </div>        
                </form>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="/src/assets/js/cadastro.js"></script>
</body>
</html>
