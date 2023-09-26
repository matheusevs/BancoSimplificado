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
                    overlay.style.display = 'none';
                    window.location.href = "/";

                } else {

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

});

jQuery(document).ready(function(){
    var userCreate = window.location.href;

    if(userCreate.includes('success')){
        toastr.success('Usuário cadastrado com sucesso!');
        return;
    }

    if(userCreate.includes('errorToken')){
        toastr.warning('Ocorreu um erro na validação do seu token, realize o login novamente por favor!');
        return;
    }

})
