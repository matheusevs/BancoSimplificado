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
                    $('#nomeEdit').val(res.name);
                    $('#emailEdit').val(res.email);
                    $('#roles').val(res.roles);

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

                    window.location.reload();

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

                    window.location.reload();

                } else {

                    toastr.error(res.error,'Erro!');

                }

            }

        });
    
    });

});