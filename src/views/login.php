<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link type="text/css" rel="stylesheet" href="/src/views/css/login.css">
</head>
<body>
    
    <div class="overlay">
        <div class="loading-spinner">
            <div class="spinner"></div>
        </div>
    </div>

    <div class="login-container">
        <h1>Login</h1>
        <form id="formLogin">
            <div class="input-container">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="input-container">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn-login">Entrar</button>
        </form>
        <p class="signup-link">Ainda não possui uma conta? <a href="/cadastrar">Cadastrar</a></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="/src/views/js/login.js"></script>
</body>
</html>
