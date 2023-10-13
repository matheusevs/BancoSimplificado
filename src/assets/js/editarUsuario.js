
jQuery(document).ready(function(){
    let user = window.location.href;

    $(document).on('click', '.btn-edit', function() {
        
        let id = $(this).val();
        
        $.ajax({
            type: "GET",
            url: `/MeuUsuario/${id}`,
            contentType: 'application/json',
            success: res => {

                res = JSON.parse(res);

                if(!res.error){

                    $('#id').val(res.id);
                    $('#nomeEdit').val(res.name);
                    $('#emailEdit').val(res.email);

                } else {

                    toastr.error(res.error,'Erro!');

                }
            }
        });
        
    });

    $("#formEdit").on("submit", event => {

        event.preventDefault();

        const formulario = document.getElementById("formEdit");
        const formData = new FormData(formulario);
        const form = Object.fromEntries(new URLSearchParams(formData).entries());

        $.ajax({
            type: "PUT",
            url: `/editarMeuUsuario/${form.id}`,
            data: JSON.stringify(form),
            contentType: 'application/json',
            success: res => {

                res = JSON.parse(res);
                $("#fecharEditar").click();

                if(!res.error){

                    window.location.href = "/editarMeuUsuario" + '?myUser=successUpdateMyUser';

                } else {

                    toastr.error(res.error,'Erro!');

                }

            }

        });

    });

    $("#formAlterarSenha").on("submit", event => {

        event.preventDefault();

        const formulario = document.getElementById("formAlterarSenha");
        const formData = new FormData(formulario);
        const form = Object.fromEntries(new URLSearchParams(formData).entries());

        let id = $('.btn-alterPassword').val();

        if(form.passwordNew != form.passwordNewConfirm){
            document.getElementById("confirmarSenha").classList.add("error");
            document.getElementById("password-error").textContent = "Senhas não correspondem";
            return;
        }

        $.ajax({
            type: "PUT",
            url: `/editarSenha/${id}`,
            data: JSON.stringify(form),
            contentType: 'application/json',
            success: res => {

                res = JSON.parse(res);
                
                if(!res.error){

                    window.location.href = "/login";

                } else {

                    toastr.error(res.error,'Erro!');

                }

            }

        });

    });

    $('#togglePassword').click(function () {
        let senhaInput = $('#senhaAtual');
        let tipo = senhaInput.attr('type');

        if(tipo === 'password'){
            senhaInput.attr('type', 'text');
            senhaInput.parent().addClass('password-visible');
        } else {
            senhaInput.attr('type', 'password');
            senhaInput.parent().removeClass('password-visible');
        }
    });

    $('#togglePasswordConfirm').click(function () {
        let senhaInput = $('#novaSenha');
        let tipo = senhaInput.attr('type');

        if(tipo === 'password'){
            senhaInput.attr('type', 'text');
            senhaInput.parent().addClass('password-visible');
        } else {
            senhaInput.attr('type', 'password');
            senhaInput.parent().removeClass('password-visible');
        }
    });

    if(user.includes('successUpdateMyUser')){
        toastr.success('Usuário atualizado com sucesso!');
        return;
    }
})
