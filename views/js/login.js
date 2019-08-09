$(function(argument) {
 enviar_datos();

  $('#button-close').on("click",function(argument) {
 	location.reload();
 })
})

function enviar_datos(callback){
 $('#form-login').on("submit",function(ev) {
 	ev.preventDefault();
  
 	var usuario = $('#username').val();
    var contraseña = $('#password').val();
     
    if(usuario == '' || contraseña == ''){
     toastr.info("Campos Vacios");
    } else {
  var $json = {
  	username : usuario,
    password : contraseña
  }
   var $data = $json;
   $.ajax({
   	 url : "controllers/wlogin.php",
     type : "POST",
     data : $data,
     error : function(response) {
     	console.log(response);
     },
     success : function(response) {
     	console.log("response: "+response);
        if (response == 1 ){
        console.log(response);
       window.location.replace("http:/sistema_infortri/views/dashboard.php");
        }else if(response == 0) {
     		$('#message_login').show("slow");
     		toastr_message();
     	}
     }
   })
}
 })

 function toastr_message() {
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
$('#username').val('');
$('#password').val('');
toastr.info("Verifique sus datos");

 }
}
