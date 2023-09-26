$(function(){

    $(document).on('click', '.btn-edit', function() {
        
        let id = $(this).val();

        $.ajax({
            type: "GET",
            url: `/usuarios/${id}`,
            contentType: 'application/json',
            success: res => {

                res = JSON.parse(res);
                console.log(res);

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

});