$(function(){

    $("#formLogin").on("submit", event => {

        event.preventDefault();

        const formulario = document.getElementById("formLogin");
        const formData = new FormData(formulario);
        const form = Object.fromEntries(new URLSearchParams(formData).entries());

        let overlay = document.querySelector('.overlay');
        overlay.style.display = 'flex';

        $.ajax({
            type: "POST",
            url: `/login`,
            data: JSON.stringify(form),
            contentType: 'application/json',
            success: res => {

                res = JSON.parse(res);

                if(!res.error){

                    let currentDate = new Date();
                    let expirationDate = new Date(currentDate.getTime() + (24 * 60 * 60 * 1000));
                    let expires = "expires=" + expirationDate.toUTCString();
                    document.cookie = 'Authorization=' + res.token + '; ' + expires + '; path=/;';
                    window.location.href = "/";

                } else {

                    $('#password').val('');
                    toastr.error(res.error,'Erro!');
                    overlay.style.display = 'none';
                    
                }

            }

        });

        overlay.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
        });

    });

    $('#togglePassword').click(function () {
        let senhaInput = $('#password');
        let tipo = senhaInput.attr('type');

        if(tipo === 'password'){
            senhaInput.attr('type', 'text');
            senhaInput.parent().addClass('password-visible');
        } else {
            senhaInput.attr('type', 'password');
            senhaInput.parent().removeClass('password-visible');
        }
    });

    document.getElementById('logoutButton').addEventListener('click', e => {
        e.preventDefault();
        $('#logoutModal').modal('show');
    });

    document.getElementById('logout').addEventListener('click', e => {
        e.preventDefault();

        let overlay = document.querySelector('.overlay');
        overlay.style.display = 'flex';

        $.ajax({
            type: "POST",
            url: `/logout`,
            contentType: 'application/json',
            success: res => {

                res = JSON.parse(res);
                
                if(res){
                    window.location.href = "/login" + '?userCreate=logoutSuccess';
                }

            }

        });

        overlay.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
        });

    })

});

jQuery(document).ready(function(){
    var userCreate = window.location.href;

    if(userCreate.includes('successCadastro')){
        toastr.success('Usuário cadastrado com sucesso!');
        return;
    }

    if(userCreate.includes('logoutSuccess')){
        toastr.success('Logout realizado com sucesso');
        return;
    }

    if(userCreate.includes('errorToken')){
        toastr.warning('Ocorreu um erro na validação do seu token, realize o login novamente por favor!');
        return;
    }

    if(userCreate.includes('successPassword')){
        toastr.success('Senha alterada com sucesso!');
        return;
    }

})
