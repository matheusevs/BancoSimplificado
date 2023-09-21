$(function(){

    $(document).on('click', '.btn-edit', function() {
        
        let id = $(this).val();

        $.ajax({
            type: "GET",
            url: `/itens/${id}`,
            contentType: 'application/json',
            success: res => {

                res = JSON.parse(res);

                if(!res.error){

                    $('#id').val(res.id);
                    $('#itemEdit').val(res.item);
                    $('#qtdItemEdit').val(res.qtdItem);

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
            url: `/editarItem/${form.id}`,
            data: JSON.stringify(form),
            contentType: 'application/json',
            success: res => {

                $("#fecharEditar").click();

                if(!res.error){

                    toastr.success(res.message,'Sucesso!');
                    window.location.reload();


                } else {

                    toastr.error(res.error,'Erro!');

                }

            }

        });

    });

    $("#formDelete").on("submit", event => {

        event.preventDefault();

        const id = $('.btn-delete').val();

        $.ajax({
            type: "DELETE",
            url: `/deletarItem/${id}`,
            contentType: 'application/json',
            success: res => {

                $("#fecharDeletar").click();

                if(!res.error){

                    toastr.success(res.message,'Sucesso!');
                    window.location.reload();


                } else {

                    toastr.error(res.error,'Erro!');

                }

            }

        });
    
    });

});