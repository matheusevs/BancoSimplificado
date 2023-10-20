jQuery(document).ready(function(){ 

    $("#formTransaction").on("submit", event => {

        event.preventDefault();

        const formulario = document.getElementById("formTransaction");
        const formData = new FormData(formulario);
        const form = Object.fromEntries(new URLSearchParams(formData).entries());

        let btnTransactionConfirm = document.getElementById("btn-transaction-confirm");
        let id = btnTransactionConfirm.getAttribute("data-id");
        form.idUw = id;

        let overlay = document.querySelector('.overlay');
        overlay.style.display = 'flex';

        $.ajax({
            type: "POST",
            url: '/transaction',
            data: JSON.stringify(form),
            contentType: 'application/json',
            success: res => {

                res = JSON.parse(res);
                
                if(!res.error){

                    toastr.success(res.message,'Sucesso!');

                } else {

                    toastr.error(res.error,'Erro!');
    
                }

                overlay.style.display = 'none';

            }

        });

        overlay.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
        });

    });

});