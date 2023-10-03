
jQuery(document).ready(function(){

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
})
