
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
                    $('#nomeEdit').val(res.full_name);
                    $('#cpfCnpjEdit').val(res.cpf_cnpj);
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

                    window.location.href = "/login" + '?myUser=successPassword';

                } else {

                    toastr.error(res.error,'Erro!');

                }

            }

        });

    });

    $(document).on('click', '.btn-delete', function() {
        
        let id = $(this).val();
        let btnConfirmDelete = document.getElementById("btn-confirm-delete");
        btnConfirmDelete.setAttribute("data-id", id);
        
    });

    $("#formDelete").on("submit", event => {

        event.preventDefault();
        let btnConfirmDelete = document.getElementById("btn-confirm-delete");
        let id = btnConfirmDelete.getAttribute("data-id");

        $.ajax({
            type: "DELETE",
            url: `/deletarMeuUsuario/${id}`,
            contentType: 'application/json',
            success: res => {

                res = JSON.parse(res);
                $("#fecharDeletar").click();

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

    function formatCnpjCpf(input) {
        const value = input.value;
        const cnpjCpf = value.replace(/\D/g, '');
        const maxLength = 14;
      
        if(cnpjCpf.length > maxLength){
  
          input.value = cnpjCpf.slice(0, maxLength);
  
        } else {
  
          if(cnpjCpf.length === 11){
            input.value = cnpjCpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/g, "$1.$2.$3-$4");
          } else {
            input.value = cnpjCpf.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/g, "$1.$2.$3/$4-$5");
          }
  
        }
      }
      
      $('#cpfCnpjEdit').on('input', function() {
        formatCnpjCpf(this);
      });
})
