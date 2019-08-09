$('document').ready(function(argument) {
    function dashboard(argument) {
        configure_input();
        configure_toastr();
        configure_datatable(function(argument) {
            var $buscar_button = $('#submit');
            $buscar_button.on("click", function() {
               var $filtro = $('select.filtro').val();
               busqueda_listar($filtro);
            })
        });
    }

    function configure_input() {
       select_configure();
    }

    function configure_datatable(filtrosbusqueda) {
        var $loading = $('.lds-spinner');
        var $f = new Date();
        var day = $f.getDate();
        var mes = $f.getMonth() + 1;
        var ano = $f.getFullYear();
         
        var t = $('#tblregistros').DataTable({
            "pageLength": 30,
            "searching": true,
            "ordering": true,
            "lengthChange": true,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copy',
                    text: 'COPY',
                },
                {
                    extend: 'excelHtml5',
                    text: 'EXCEL',
                    title: 'Fecha De Reporte'+ ' ' + day + '/' + mes + '/' + ano,
                    filename: 'Informatica y tributos' + '/' + day + '/' + mes + '/' + ano,
                },  
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                      customize: function(doc) {
                        doc.content.splice(1, 0, {
                            margin: [0, 0, 0, 12],
                            alignment: 'left',
                            image: 'data:image/png;base64,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',
                            width: 180,
                            height: 50
                        });
                    },
                    title: 'Fecha de Reporte' + ' ' + day + '/' + mes + '/' + ano,
                    filename: 'Informatica y tributos' + '  ' + day + '/' + mes + '/' + ano,
                    pageSize: 'LETTER',
                    pageOrientation: 'landscape',
                    pageMargins: [45, 15, 20, 15], // margin: [left, top, right, bottom]
                     styles: {
                         header: {
                          fontSize: 22,
                          bold: true
                           },
                             body: {
                                italic: true,
                                margin: [40, 5, 0, 12],
                            }
                      }
                }]
        });
        t.column(5).visible(false);
        $loading.remove();
        /*
        $.ajax({
            url: "../controllers/wdatatable.php?url=listar",
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
                  
                 t.order( [ 2, 'asc' ], [ 3, 'asc' ] ).draw();
                 //t.column(0).visible( false );
                $loading.remove();
                pintar_estado($leng_data);
                //t.row.add(data[i]).draw();  
            }
        })
        */
        filtrosbusqueda();
    }


    function pintar_estado($leng_data) {
        console.log('Entre a pintar_estado')
        $tabla = $('#tblregistros').DataTable();
        for (var i = 0; i < $leng_data; i++) {
            var $entrada = $tabla.cell(i, 3).data();
            var $salida = $tabla.cell(i, 4).data();

            if ($entrada == $salida){
                 var $e =$entrada.substring(11,19);
                 var $s = $entrada.substring(11,19);
                var $cell = $tabla.cell(i, 3).node();
                var $cell2 = $tabla.cell(i, 4).node();
            
               if($e < '08:03:59'){
                 $tabla.cell(i, 3)
                $($cell).css({
                    "background-color":"#E6EE9C",
                    "color":"white"
                })   
               } else {
                  $tabla.cell(i, 3)
                $($cell).css({
                    "background-color":"#E57373",
                    "color":"white"
                }) 
               }
               
                $tabla.cell(i, 4)
                $($cell2).css({
                    "background-color":"#E57373",
                    "color":"white"
                }) 
            }
            
        }
    }

/*
$(document).on('click', '#b_update_paises', function(){
    var id = $(this).parents("tr").find("td").eq(0).html();
    var nombre = $(this).parents("tr").find("td").eq(1).html();
    var activo = $(this).parents("tr").find("td").eq(2).html();
    
    $('input#txt_id').val(id);
    $('input#txt_nombre').val(nombre);
    $('select#list_activo').val(activo);
});
*/
function busqueda_listar($tipo_busqueda) {
     $tabla = $('#tblregistros').DataTable();
         var $tmpl_spinner = $('<div class="lds-spinner">'+
         '<div></div>'+
         '<div></div>'+
         '<div></div>'+
         '<div></div>'+
         '<div></div>'+
         '<div></div>'+
         '<div></div>'+
         '<div></div>'+
         '<div></div>'+
         '<div></div>'+
         '<div></div>'+
         '<div></div>'+
         '</div>');
    var $length_data;
    var $nombre=$('#nombre').val();
    var $fecha =$('#datepicker').val();
    var string_fecha = $('#reservation').val();
    var $fecha_inicial,$fecha_final;

       if($tipo_busqueda == 1){
         toastr.info("Busqueda por empleado");
        if(!$nombre){
          toastr.error("Campo Nombre requerido");   
        } else if($nombre){
             if($fecha){
                console.log("entrando busqueda fecha: " + $fecha );
            var mes = $fecha.substring(0,2);
            var dia = $fecha.substring(5,3);
            var ano = $fecha.substring(6,10);
           var $fecha_convert = ano+"-"+mes+"-"+dia; 
            var $data={
              nombre : $nombre,
              fecha : $fecha_convert
           }
           $('#datepicker').val('');
           $('#nombre').val('');
        } else if(string_fecha) {
            console.log("entrando busqueda fecha_rango");
          $fecha_inicial = string_fecha.substring(0, 10);        
          $fecha_final = string_fecha.substring(12, 23);
        //convirtiendo fechas rango en formato aceptado por la base de datos
            var mes_inicial = $fecha_inicial.substring(0,2);
            var dia_inical = $fecha_inicial.substring(5,3);
            var ano_inicial = $fecha_inicial.substring(6,10);
         //09/15/2018 formato obtenido por imput rango_fechas
            var mes_final = $fecha_final.substring(1,3);
            var dia_final = $fecha_final.substring(4,6);
            var ano_final = $fecha_final.substring(7,11);
    
           var $fecha_convert1 = ano_inicial+"-"+mes_inicial+"-"+dia_inical; 
           var $fecha_convert2 = ano_final+"-"+mes_final+"-"+dia_final; 
            var $data={
              fecha_rango : "fecharango",  
              nombre : $nombre,
              fecha_inicial: $fecha_convert1,
              fecha_final : $fecha_convert2
           }
         }
          $('#nombre').val('');
          $('.container_spinner').append($tmpl_spinner);
           $tabla.clear().draw();
          $.ajax({
            url: "../controllers/wdatatable.php?url=porempleado",
            type: "POST",
            data : $data,
            datatype: "json",
            success: function(response){

                var $data=JSON.parse(response);
                for(var i in $data){
                 $tabla.row.add($data[i]).draw();
                }
   
                $length_data=$data.length;
                pintar_estado($length_data);
                $tabla.order( [ 3, 'asc' ], [ 4, 'asc' ] ).draw();
              $('.container_spinner').find('.lds-spinner').remove();
            }
        })
        }
       } else if ($tipo_busqueda == 2){
            var $departamento = $('select.department').val();
            var $fecha =$('#datepicker').val();
            var $string_fecha = $('#reservation').val();
            if($departamento){
              if($fecha){
                console.log('buscando por fecha');
                    var mes = $fecha.substring(0,2);
                    var dia = $fecha.substring(5,3);
                    var ano = $fecha.substring(6,10);
                   var $fecha_convert = ano+"-"+mes+"-"+dia; 
                   console.log($fecha_convert);
              var $data={
                   area : $departamento,
                   fecha : $fecha_convert
                }
                $('#datepicker').val('');    
              }else if($string_fecha){
                 toastr.info("Buscando departamento por rango de fecha");
          $fecha_inicial = string_fecha.substring(0, 10);        
          $fecha_final = string_fecha.substring(12, 23);
        //convirtiendo fechas rango en formato aceptado por la base de datos
            var mes_inicial = $fecha_inicial.substring(0,2);
            var dia_inical = $fecha_inicial.substring(5,3);
            var ano_inicial = $fecha_inicial.substring(6,10);
         //09/15/2018 formato obtenido por imput rango_fechas
            var mes_final = $fecha_final.substring(1,3);
            var dia_final = $fecha_final.substring(4,6);
            var ano_final = $fecha_final.substring(7,11);
    
           var $fecha_convert1 = ano_inicial+"-"+mes_inicial+"-"+dia_inical; 
           var $fecha_convert2 = ano_final+"-"+mes_final+"-"+dia_final; 
            var $data={
              fecha_rango : "fecharango",  
              area : $departamento,
              fecha_inicial: $fecha_convert1,
              fecha_final : $fecha_convert2
              }
            }
             $('.container_spinner').append($tmpl_spinner);
             $tabla.clear().draw();                  
            $.ajax({
            url: "../controllers/wdatatable.php?url=pordepartamento",
            type: "POST",
            data : $data,
            datatype: "json",
            success: function(response){
                console.log(response);
                 var $data=JSON.parse(response);
                 
                for(var i in $data){
                 $tabla.row.add($data[i]).draw();
                }
                 $length_data=$data.length;
                pintar_estado($length_data);

                $tabla.order( [ 3, 'asc' ], [ 4, 'asc' ] ).draw();
              $('.container_spinner').find('.lds-spinner').remove();
               }
            })

          }
      } else if($tipo_busqueda == 3) {
         var $fecha =$('#reservation').val();

         if($fecha){
             var mes = $fecha.substring(0,2);
             var dia = $fecha.substring(5,3);
             var ano = $fecha.substring(6,10);
             var $fecha_convert = ano+"-"+mes+"-"+dia; 
             console.log($fecha_convert);
                var $data={
                   fecha : $fecha_convert
                }  
          $('.container_spinner').append($tmpl_spinner);
           $tabla.clear().draw();
          $.ajax({
            url: "../controllers/wdatatable.php?url=pordia",
            type: "POST",
            data : $data,
            datatype: "json",
            success: function(response){
                var $data=JSON.parse(response);
     
                for(var i in $data){
                 $tabla.row.add($data[i]).draw();
                }
               $length_data=$data.length;
                pintar_estado($length_data);

                $tabla.order( [ 3, 'asc' ], [ 4, 'asc' ] ).draw();
              $('.container_spinner').find('.lds-spinner').remove();
            }
        })
         } else{
           toastr.error("Campo fecha!");
         }
      }else if ($tipo_busqueda == 4){
         var $mes=$('select.select2').val();
         if($mes){
            $data = {
                mes : $mes
            }
            $('.container_spinner').append($tmpl_spinner);
           $tabla.clear().draw();
            $.ajax({
                url: "../controllers/wdatatable.php?url=pormes",
            type: "POST",
            data : $data,
            datatype: "json",
            success: function(response){
                //console.log(response);
                var $data=JSON.parse(response);
                for(var i in $data){
                 $tabla.row.add($data[i]).draw();
                }
                $length_data=$data.length;
                pintar_estado($length_data);

                $tabla.order( [ 3, 'asc' ], [ 4, 'asc' ] ).draw();
              $('.container_spinner').find('.lds-spinner').remove();
             }
            })
         }
      }

}

    function anonym_data() {
        /*
         Funcion para pruebas Jquery y trabajo del DataTable
        */
        //template para el cambio de encabezados, nos servira al momento de hacer los filtros de busqueda
        var $htencabezado = $('<tr>' +
            '<th style="background-color: #3C8DBC; color: white">ID</th>' +
            '<th style="background-color: #3C8DBC;color: white">NOMBRE</th>' +
            '<th style="background-color: #3C8DBC;color: white">FECHA</th>' +
            '<th style="background-color: #3C8DBC;color: white">DESCRIPCION</th>' +
            '<th style="background-color: #3C8DBC;color: white">DEPARTAMENTO</th>' +
            '<th style="background-color: #3C8DBC;color: white">EVENTO</th>' +
            '<th class="estado" style="background-color: #3C8DBC;color: white">ESTADO</th>' +
            '</tr>');

        var $htspinner = $('<div class="lds-spinner">' +
            '<div></div>' +
            '<div></div>' +
            '<div></div>' +
            '<div></div>' +
            '<div></div>' +
            '<div></div>' +
            '<div></div>' +
            '<div></div>' +
            '<div></div>' +
            '<div></div>' +
            '<div></div>' +
            '<div></div>' +
            '</div>');

        var $tbls = $('#tblregistros').DataTable();
        $('#cleanerbutton').on("click", function() {
            //08/13/2018 - 08/23/2018
            var string_fecha = $('#reservation').val();
            var fecha_inicial = string_fecha.substring(0, 10);
            var fecha_final = string_fecha.substring(12, 23);
            //console.log('Fechas extraidas del imput #reservation');
            //console.log(fecha_inicial + '  ' + fecha_final);
            //$('.container_spinner').append($htspinner);
            $tbls.clear().draw(); /*Borra los datos de la tabla metodo clear()*/
            $('#tbl-encabezado').html($htencabezado);
        })

        $('#tbl-encabezado th').each(function(index) {
          //  console.log($(this).attr("style"));
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


    function select_configure(argument) {
         $("#input_control_mes").hide();
        $("select.department").prop('disabled', true);
        $("select.filtro").change(function(argument) {
            if ($(this).val() == '1') {
                 $("#nombre_input_col").show();
                $("#input_control_departa").show();
                $("#rango_input_col").show();
                $("#input_control_mes").hide();

                $("#nombre").prop('disabled', false);
                $('#reservation').prop('disabled', false);
                $("select.department").prop('disabled', true);
            } else if ($(this).val() == '2') {
                $("#nombre_input_col").show();
                $("#input_control_departa").show();
                $("#rango_input_col").show();

                $("#nombre").prop('disabled', true);
                $("#reservation").prop('disabled', false);
                $("select.department").prop('disabled', false);
                $("#input_control_mes").hide();

                $('#datepicker').val('');
                $('#nombre').val('');
            } else if ($(this).val() == '3') {
                $("#nombre_input_col").hide();
                $("#input_control_departa").hide();
                $("#rango_input_col").show();
                $("#input_control_mes").hide();

                $('#datepicker').val('');
                $('#nombre').val('');
            } else if ($(this).val() == '4') {
                $("#input_control_mes").show();
                $("#nombre_input_col").hide();
                $("#input_control_departa").hide();
                $("#rango_input_col").hide();

                $('#datepicker').val('');
                $('#nombre').val('');
            }
        })
    }

    dashboard();
});

