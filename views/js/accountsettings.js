$(function(argument) {
  function configure_accountsettings(argument) {
  	
  	event_click_pasword();
  	change_password();
  }

  function event_click_pasword(argument) {
  	$('.input-group-addon').click(function(argument) {
         var padre_element = $(this).parent();
  		var dato = $(this).find('icon').attr("class");
  		if(dato == 'fa fa-eye-slash'){
          $(this).find('icon').attr({'class' : 'fa fa-eye'})
          $(padre_element).find('input').attr("type","text");
  		} else{
  			$(this).find('icon').attr({'class' : 'fa fa-eye-slash'})
  			$(padre_element).find('input').attr("type","password");	
  		}
  	})
  }

  function change_password(){
  	    $alert_error = $('.box-body').find('#alert-info-error');
        $alert_sucess = $('.box-body').find('#alert-info-succes');

  	 $('#change-button').on("click",function(argument) {
         var $actual=$('#password').val();
         var $nueva = $('#nueva_password').val();
         var $repetir_nueva = $('#repetir_password').val();

         if(!$actual || !$nueva || !$nueva ){
           toastr.error("Campos Requeridos sin llenar");
         } else {
         if($nueva == $repetir_nueva){
            if ($nueva.length <= 6 ){
                console.log('Entro');
                $('#info_alert').text("Verifique longitud de contraseña! Mayor a 6 Caracteres");
                $alert_error.show("slow");
                close();
            } else {
               $.post("../controllers/wdatatable.php?url=cambiarpass",{passactual: $actual,pass_nueva:$nueva},function(response){
               if(response == 1 ){
                $alert_sucess.show("slow");
                $('.input-group').find('input').val(" ");
                close();
               } else {
                 $alert_error.show("slow");
                 $('.input-group').find('input').val(" ");
                 close();
               }
             })
            }
         }else {
         	console.log('entre estilo');
         	$('.input_validar').css({
         		 "borderColor": "red"
         	})
         	toastr.error("Contraseñas No Coinciden");
          }
         }
       
  	 })  
  
  }

   function configure_toastr(){
        toastr.options = {
           "closeButton": false,
           "debug": false,
           "newestOnTop": false,
           "progressBar": false,
           "positionClass": "toast-top-right",
           "preventDuplicates": false,
           "onclick": null,
           "showDuration": "300",
           "hideDuration": "1000",
           "timeOut": "5000",
           "extendedTimeOut": "1000",
           "showEasing": "swing",
           "hideEasing": "linear",
           "showMethod": "fadeIn",
           "hideMethod": "fadeOut"
         }
    }

function close(argument) {
	$(".close").on("click", function(argument) {
       location.reload();
    })
}


 configure_accountsettings();
})