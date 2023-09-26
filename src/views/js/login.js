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
                document.cookie = 'Authorization=' + res.token + '; expires=Thu, 01 Jan 2099 00:00:00 UTC; path=/;';
                overlay.style.display = 'none';

                if(!res.error){

                    window.location.href = "/";

                } else {

                    toastr.error(res.error,'Erro!');
    
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

})
