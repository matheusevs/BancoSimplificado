$(function(){

    $("#formCadastro").on("submit", event => {

        event.preventDefault();

        const formulario = document.getElementById("formCadastro");
        const formData = new FormData(formulario);
        const form = Object.fromEntries(new URLSearchParams(formData).entries());


        if(form.senha != form.confirmar_senha){
            document.getElementById("confirmar_senha").classList.add("error");
            document.getElementById("password-error").textContent = "Senhas não correspondem";
            return;
        }

        document.getElementById("password-error").textContent = "";
        document.getElementById("confirmar_senha").classList.remove("error");

        let overlay = document.querySelector('.overlay');
        overlay.style.display = 'flex';

        $.ajax({
            type: "POST",
            url: `/createUser`,
            data: JSON.stringify(form),
            contentType: 'application/json',
            success: res => {

                res = JSON.parse(res);
                overlay.style.display = 'none';

                if(!res.error){

                    window.location.href = "/login" + '?userCreate=success';

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