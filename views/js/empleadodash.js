/**
* Js Listado Empleados
*/

$(function (argument) {
   
function empleado_dashboard(argument) {
	configure_datatable(); //Funcion para la inicializacion del Datatable
    select_cell_button();
}


function configure_datatable(argument) {
	var $loading = $('.lds-spinner');
	var t = $('#tblempleados').DataTable({ 
            "pageLength": 10, //Paginado del datatable
            "searching": true,
            "ordering": true,
            "lengthChange": true
        });
                 
	 $.ajax({          //Peticion Ajax para obtener listado de empleados                  
            url: "../controllers/wdatatable.php?url=listado_empleados",
            type: "GET",
            datatype: "json",
            success: function(response){
                //console.log(response);
                 var $data = JSON.parse(response);
                 var $leng_data = $data.length;
                 //console.log($data);
                  for( var i in $data){
                   t.row.add($data[i]).draw();
                  }
                 t.order( [ 2, 'asc' ]).draw();
                 $loading.remove();
            }
        })      
}


/**
* Funcion para actividad de los botones Editar y Estado 
* #btn_remover   -  #btn_check
*/
function select_cell_button() {

    var $form_cedula=$('#modal_cedula');
    var $form_nombre=$('#modal_nombre');
    var $form_direccion=$('#modal_direccion');
    var $form_telefono = $('#modal_telefono');
    var $form_email = $('#modal_email');
    var $form_departamento = $('select.model_departamento');
    var $form_sucursal = $('select.model_sucursal');
    var $form_id = $('#modal_id');
    
    var $tbl = $('#tblempleados').DataTable();
    $('#tblempleados tbody').on("click","#btn_remover",function(argument) {
       var $id = $(this).parents("tr").find("td").eq(0).html();
        var $row_actual = $(this).parents("tr");
     get_estado($id); 
     alertify.confirm('Informatica y Tributos',"Estado! Esta Seguro de cambiar el Estado del empleado? ",
       function(){
          //$tbl.row($row_actual).remove().draw();
          change_Estado($id);
        },
    function(){
        console.log($id);
        toastr.info("Accion Cancelada");
    });
 });

    $('#tblempleados tbody').on("click","#btn_check",function(argument) {
        var $id = $(this).parents("tr").find("td").eq(0).html();
         console.log($id);
         $.get("../controllers/wdatatable.php?url=empleado",{id: $id},function(response) {
            var $data = JSON.parse(response);
            console.log($data);
            $form_id.val($data[0][0]);
            $form_cedula.val($data[0][9]);
            $form_nombre.val($data[0][1]);
            $form_telefono.val($data[0][2]);
            $form_direccion.val($data[0][3]);
            $form_email.val($data[0][4]);
            $form_departamento.val($data[0][8]);
            $form_sucursal.val($data[0][6]);

            console.log($data[0][0]);
         }) 
       $('#modal-default').modal();
       $('#modal_id').prop("disabled",true);
    });

    $('#btn_close').on("click",function(argument) {
        $form_id.val(' ');
        $form_cedula.val(' ');
        $form_nombre.val(' ');
        $form_direccion.val(' ');
        $form_telefono.val('  ');
        $form_email.val(' '); 
        $form_departamento.val(' ');
    })
    save_employes();
}

/*Funcion para cambiar estado del empleado*/
function change_Estado($id) {
    var $json = { id : $id};
    $.post("../controllers/wdatatable.php?url=estado",$json,function(response) {
       if(response == 1){
         console.log(response);
         toastr.info("Estado Empleado Modificado");
       } else {
        console.log(response);
        toastr.info("No se ha encontrado empleado");
       }
    })
}

/*Simple function para saber el Estado del empleado en la base de datos*/
function get_estado($id) {
    var $valor_estado;
       $.get("../controllers/wdatatable.php?url=devolver_estado",{id : $id},function(response){
            var dato = JSON.parse(response);
            $valor_estado =  dato[0][0];
            if($valor_estado == 'S'){
             $('.ajs-content').html("El estado actual del empleado es <b>Activo</b>. Desea cambiar su estado a <b>Inactivo</b>?");
            } else {
             $('.ajs-content').html("El estado actual del empleado es <b>Inactivo</b>. Desea cambiar su estado a <b>Activo</b> ?");
            }
        })
}

/*Function para guardar o editar un empleado */
function save_employes() {
    $('#btn_save').on("click",function(argument){
     var $id = $('#modal_id').val();   
     var $cedula = $('#modal_cedula').val();
     var $nombre = $('#modal_nombre').val();
     var $direccion = $('#modal_direccion').val();
     var $telefono = $('#modal_telefono').val();
     var $email =  $('#modal_email').val();
     var $area =  $('select.model_departamento').val();
     var $sucursal =  $('select.model_sucursal').val();

        if(!$cedula || !$nombre || !$email || !$area || !$direccion || !$telefono || !$sucursal){
           toastr.error("Complete los campos");
        }else {
            var $data = {'accion': 'save','id':$id,'cedula' : $cedula,
                 'nombre': $nombre,'direccion': $direccion,telefono: $telefono,
                'email' : $email,'area' : $area,'sucursal' : $sucursal};
           console.log($data); //console del json datos empleado
            $.post("../controllers/wdatatable.php?url=save",$data,function(response) {
                 if(response == 1){
                    console.log(response);
                     $('#modal-default input').val('  ');
                     $('select.model_departamento').val('  ');
                     toastr.info("Empleado Editado Correctamente");
                      $('#modal-default').modal('hide');
                 }else if(response == 2){
                     console.log(response);
                     $('#modal-default input').val('  ');
                     $('select.model_departamento').val('  ');
                     toastr.success("Registro completado");
                     $('#modal-default').modal('hide');
                 } else if(response == 0) {
                    console.log(response);
                    console.log('ERROR SERVER');
                 }
            })
        }
    })
}

empleado_dashboard();

})