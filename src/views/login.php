<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link type="text/css" rel="stylesheet" href="/src/views/css/login.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form>
            <div class="input-container">
                <label for="username">Usuário:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-container">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn-login">Entrar</button>
        </form>
        <p class="signup-link">Ainda não possui uma conta? <a href="#">Cadastrar</a></p>
    </div>
</body>
</html>
