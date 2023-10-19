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

                if(!res.error){

                    window.location.href = "/login" + '?userCreate=successCadastro';

                } else {

                    overlay.style.display = 'none';
                    toastr.error(res.error,'Erro!');
    
                }

            }

        });

        overlay.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
        });

    });

    $('#togglePassword').click(function () {
        let senhaInput = $('#senha');
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
        let senhaInput = $('#confirmar_senha');
        let tipo = senhaInput.attr('type');

        if(tipo === 'password'){
            senhaInput.attr('type', 'text');
            senhaInput.parent().addClass('password-visible');
        } else {
            senhaInput.attr('type', 'password');
            senhaInput.parent().removeClass('password-visible');
        }
    });

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
    
    $('#cpfcnpj').on('input', function() {
      formatCnpjCpf(this);
    });
    
});

