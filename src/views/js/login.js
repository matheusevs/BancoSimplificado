document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('login-form');
    const errorMessage = document.getElementById('error-message');

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const username = loginForm.username.value;
        const password = loginForm.password.value;

        if (username === 'seu_usuario' && password === 'sua_senha') {
            alert('Login bem-sucedido!');
        } else {
            errorMessage.textContent = 'Nome de usuário ou senha incorretos.';
        }
    });
});
