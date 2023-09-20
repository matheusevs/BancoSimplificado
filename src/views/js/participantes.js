$(function(){

    $(document).on('click', '.btn-edit', function() {
        
        let id = $(this).val();

        $.ajax({
            type: "GET",
            url: `/participantes/${id}`,
            contentType: 'application/json',
            success: res => {

                res = JSON.parse(res);

                if(!res.error){

                    $('#id').val(res.id);
                    $('#nomeEdit').val(res.nome);
                    $('#qtdConsumoEdit').val(res.consumo);

                } else {

                    toastr.error(res.message,'Erro!');

                }
            }
        });
        
    });

});