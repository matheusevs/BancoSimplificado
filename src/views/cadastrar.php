<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="/src/assets/css/login.css">
</head>
<body>

    <div class="overlay">
        <div class="loading-spinner">
            <div class="spinner"></div>
        </div>
    </div>

    <div class="login-container">
        <h1>Cadastro de Usuário</h1>
        <form id="formCadastro">
            <div class="input-container">
                <label for="nome">Nome completo:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="input-container">
                <label for="cpfcnpj">CPF/CNPJ:</label>
                <input type="text" id="cpfcnpj" name="cpfcnpj" required>
            </div>
            <div class="input-container">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-container">
                <label for="senha">Senha:</label>
                <div class="password-container">
                    <input type="password" id="senha" name="senha" required>
                    <span class="toggle-password" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>
            <div class="input-container">
                <label for="confirmar_senha">Confirmar Senha:</label>
                <div class="password-container">
                    <input type="password" id="confirmar_senha" name="confirmar_senha" required>
                    <span class="toggle-password" id="togglePasswordConfirm">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                <span class="error-message" id="password-error"></span>
            </div>
            <div class="input-container">
                <label for="usertype">Tipo de usuário:</label>
                <select class="form-control" id="usertype" name="usertype">
                    <option value="comum">Usuário Comum</option>
                    <option value="lojista">Usuário Lojista</option>
                </select>
            </div>
            <button type="submit" class="btn-login">Cadastrar</button>
        </form>
        <p class="signup-link">Já possui uma conta? <a href="/login">Faça login</a></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="/src/assets/js/cadastro.js"></script>
</body>
</html>
