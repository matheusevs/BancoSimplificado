$(function(){

    $(document).on('click', '.btn-edit', function() {
        
        let id = $(this).val();

        $.ajax({
            type: "GET",
            url: `/usuarios/${id}`,
            contentType: 'application/json',
            success: res => {

                res = JSON.parse(res);

                if(!res.error){

                    $('#id').val(res.id);
                    $('#nomeEdit').val(res.full_name);
                    $('#cpfCnpjEdit').val(res.cpf_cnpj);
                    $('#emailEdit').val(res.email);
                    $('#user_type').val(res.user_type);

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
            url: `/editarUsuario/${form.id}`,
            data: JSON.stringify(form),
            contentType: 'application/json',
            success: res => {

                res = JSON.parse(res);

                $("#fecharEditar").click();

                if(!res.error){

                    window.location.href = "/listarUsuarios" + '?user=successUpdate';

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
            url: `/deletarUsuario/${id}`,
            contentType: 'application/json',
            success: res => {

                res = JSON.parse(res);

                $("#fecharDeletar").click();

                if(!res.error){

                    window.location.href = "/listarUsuarios" + '?user=successDelete';

                } else {

                    toastr.error(res.error,'Erro!');

                }

            }

        });
    
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
      
    $('#cpfCnpjEdit').on('input', function() {
        formatCnpjCpf(this);
    });

});

jQuery(document).ready(function(){
    var user = window.location.href;

    if(user.includes('successUpdate')){
        toastr.success('Usuário atualizado com sucesso!');
        return;
    }

    if(user.includes('successDelete')){
        toastr.success('Usuário excluído com sucesso!');
        return;
    }

})