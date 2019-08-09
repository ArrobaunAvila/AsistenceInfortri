$(document).ready(function() {

    enviarFile(function() {
        $(".close").on("click", function(argument) {
            location.reload();
        })
    });

    //Funcion para cargar archivos con ajax
    function enviarFile($close) {
        $alert_error = $('.box-body').find('#alert-info-error');
        $alert_sucess = $('.box-body').find('#alert-info-succes');

        $("#form").on("submit", function(e) {
            e.preventDefault();
            var $file = new FormData($("#form")[0]);
            
         $('.container_spinner').append('<div class="lds-spinner">'+'<div></div>'+'<div></div>'+
         '<div></div>'+'<div></div>'+'<div></div>'+'<div></div>'+'<div></div>'+'<div></div>'+ '<div></div>'+
         '<div></div>'+'<div></div>'+'<div></div>'+'</div>');

            $.ajax({
                    url: "../controllers/wexcel.php?url=enviarfile",
                    type: "POST",
                    data: $file,
                    contentType: false,
                    processData: false,
                    error: function(error) {
                        console.log('!Error No Envio');
                    },
                    success: function (response) {
                        console.log('Entrando al Success');
                        console.log(response);
                    if (response == 1) {
                        $('.container_spinner').find('.lds-spinner').remove();
                        $alert_sucess.show("slow");
                        $close();
                    }else {
                        $('.container_spinner').find('.lds-spinner').remove();
                        $alert_error.show("slow");
                        $close();
                     }
                    }
                })
    
        });
    }
});