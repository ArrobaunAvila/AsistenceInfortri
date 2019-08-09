<?php
 session_start();
 if(!isset($_SESSION["username"])){
  session_destroy();
  header('location: ../index.php');
  exit;
 } else if(isset($_GET["view"])){
   session_destroy();
   header('location: ../index.php');
 }
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard | Informatica-Tributos</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="shortcut icon" href="../public/img/icono.ico" type="image/x-icon" />
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../public/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../public/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../public/bower_components/Ionicons/css/ionicons.min.css">

  <!-- daterange picker -->
  <link rel="stylesheet" href="../public/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../public/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../public/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../public/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../public/bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
<link rel="stylesheet" href="../public/dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="../public/dist/css/skins/_all-skins.min.css">

<!-- alertify css  -->
<link rel="stylesheet" href="../public/plugins/alertify/css/alertify.min.css">
<!-- Toastr para mensajes notificaciones -->
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/b-1.5.2/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/datatables.min.css"/>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-html5-1.5.2/datatables.min.css"/>

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->

    <!--Datatables -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
  <script type="text/javascript" src="../public/js/jquery-3.3.1.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <style type="text/css">
    .lds-spinner {
  color: official;
  display: inline-block;
  position: relative;
  width: 64px;
  height: 64px;
}
.lds-spinner div {
  transform-origin: 32px 32px;
  animation: lds-spinner 1.2s linear infinite;
}
.lds-spinner div:after {
  content: " ";
  display: block;
  position: absolute;
  top: 3px;
  left: 29px;
  width: 5px;
  height: 14px;
  border-radius: 20%;
  background: #3C8DBC;
}
.lds-spinner div:nth-child(1) {
  transform: rotate(0deg);
  animation-delay: -1.1s;
}
.lds-spinner div:nth-child(2) {
  transform: rotate(30deg);
  animation-delay: -1s;
}
.lds-spinner div:nth-child(3) {
  transform: rotate(60deg);
  animation-delay: -0.9s;
}
.lds-spinner div:nth-child(4) {
  transform: rotate(90deg);
  animation-delay: -0.8s;
}
.lds-spinner div:nth-child(5) {
  transform: rotate(120deg);
  animation-delay: -0.7s;
}
.lds-spinner div:nth-child(6) {
  transform: rotate(150deg);
  animation-delay: -0.6s;
}
.lds-spinner div:nth-child(7) {
  transform: rotate(180deg);
  animation-delay: -0.5s;
}
.lds-spinner div:nth-child(8) {
  transform: rotate(210deg);
  animation-delay: -0.4s;
}
.lds-spinner div:nth-child(9) {
  transform: rotate(240deg);
  animation-delay: -0.3s;
}
.lds-spinner div:nth-child(10) {
  transform: rotate(270deg);
  animation-delay: -0.2s;
}
.lds-spinner div:nth-child(11) {
  transform: rotate(300deg);
  animation-delay: -0.1s;
}
.lds-spinner div:nth-child(12) {
  transform: rotate(330deg);
  animation-delay: 0s;
}
@keyframes lds-spinner {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}

.btn_acciones{
  margin-right: 5px;
}

table > tbody > tr > td:last-child{
  display: flex;
}
  </style>
<body class="hold-transition skin-blue  sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
 <?php
 /*Incluimos html que siempre usaremos*/ 
 include 'views_template/header.php';
 include 'views_template/sidebar.php';
 ?>

  <!-- Todo el Contenido de la pagina,Header y Content-->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="font-weight-bold text-dark">
        CONTROL DE ASISTENCIA
        <small>Filtros y Busquedas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="empleados_dashboard.php">Empleados</a></li>
        <li><a href="cargar_excel.php">CargarExcel</a></li>
      </ol>
    </section>

    <!-- Contenido Formulario -->
    <section class="content">
      <div class="box box-primary">
      <div class="row"> 
         <div class="col-md-12"> 
               <div class="box-header with-border">
                 <h2 class="box-title">Filtros de Busqueda</h2>
               </div>
               <form role="form">
                  <div class="box-body">
                    <div class="col-md-3">
                     <div class="form-group">
                        <label>Filtro busqueda: </label>
                  <select class="form-control filtro"  style="width: 100%;">
                  <option value="1">Busqueda por Empleado</option>
                  <option value="2">Busqueda Por Departamento</option>
                  <option value="3">Busqueda Por Dia </option>
                  <option value="4">Busqueda Por Mes</option>
                </select>            <!-- /.group select-->
                     </div>
                   </div>

  
                   <div class="col-md-3" id="nombre_input_col">
                     <div class="form-group">
                        <label>Nombre :</label>
                        <input type="text" id="nombre" class="form-control" placeholder="NOMBRE">
                     </div>
                   </div>
            
                   <div id="input_control_mes" class="col-md-3">
              <div class="form-group">
                <label>Mes</label>
                <select class="form-control select2" style="width: 100%;">
                  <option selected="selected" value="01">Enero</option>
                  <option value="02">Febrero</option>
                  <option value="03">Marzo</option>
                  <option value="04">Abril</option>
                  <option value="05">Mayo</option>
                  <option value="06">Junio</option>
                  <option value="07">Julio</option>
                  <option value="08">Agosto</option>
                  <option value="09">Septiembre</option>
                  <option value="10">Octubre</option>
                  <option value="11">Noviembre</option>
                  <option value="12">Diciembre</option>
                </select>
               </div>
              </div>
                  </div>
               </form>
            </div>
         </div>

         <div class="row" id="rango_input_col">
            <div class="col-md-12">
               <div class="col-md-5">
               <div class="form-group">
                <label>Rango Fecha:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="reservation">
                </div>
                <!-- /.input group -->
              </div>
           </div>

               <div class="col-md-4" id="input_control_departa" >
              <div class="form-group">
                  <label>Departamento</label>
                  <select class="form-control department">
                    <option class="selected" value="001">Administrativo</option>
                    <option class="selected" value="002">Operaciones</option>
                    <option class="selected" value="003">Desarrollo PLSQL</option>
                    <option class="selected" value="004">Desarrollo WEB</option>
                  </select>
                </div>
           </div>
            </div>
         </div>

         <div class="row">
             <div class="col-md-6">
                <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-left" id="submit">BUSCAR</button>
              </div>
             </div>
         </div>
      </div>

 <div class="container_spinner">
      <div class="lds-spinner">
         <div></div>
         <div></div>
         <div></div>
         <div></div>
         <div></div>
         <div></div>
         <div></div>
         <div></div>
         <div></div>
         <div></div>
         <div></div>
         <div></div>
         </div>
   </div>
    
     <div class="box container_table">
      <div class="box-body">
       <div class="row">
           <div class="col-xs-12">
              <table id="tblregistros" class="display">
                  <thead id="tbl-encabezado">
                    <tr id="tbl_row">
                    <th style="background-color: #222D32; color: white">ID</th>
                    <th style="background-color: #222D32; color: white">NOMBRE</th> 
                    <th style="background-color: #222D32; color: white">FECHA</th>
                    <th style="background-color: #222D32; color: white">ENTRADA</th>
                    <th style="background-color: #222D32; color: white">SALIDA</th>
                     <th style="background-color: #222D32; color: white">OBSERVACION</th>
                    </tr>
                  </thead>
                      <tbody>
                     </tbody>
                </table>
           </div>
        </div>
      </div>
      </div> 
      <!--Termina la caja de <table> -->
    </section>
    <!-- /.content -->
       </div>
  <!-- /.content-wrapper -->

  <?php
   include 'views_template/footer.php';
   /*
  include 'views_template/control_sidebar.php'; 
   */
   ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
<!-- ./wrapper -->
<script type="text/javascript" src="js/dashboard.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- Select2 -->
<script src="../public/bower_components/select2/dist/js/select2.full.min.js"></script>

<script src="../public/plugins/alertify/alertify.js"></script>
<!-- InputMask -->
<script src="../public/plugins/input-mask/jquery.inputmask.js"></script>
<script src="../public/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../public/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="../public/bower_components/moment/min/moment.min.js"></script>
<script src="../public/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../public/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>

<!--bootstrap colorpicker -->
<script src="../public/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>

<!-- SlimScroll -->
<script src="../public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../public/plugins/iCheck/icheck.min.js"></script>

<!-- Js toastr Mensajes notificaciones -->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- bootstrap time picker -->
<script src="../public/plugins/timepicker/bootstrap-timepicker.min.js"></script>

<!-- FastClick -->
<script src="../public/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../public/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../public/dist/js/demo.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/b-1.5.2/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-html5-1.5.2/datatables.min.js"></script>
<!-- DataTables -->

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      pickTime: false,
      autoclose: true,
      language: 'es'
    })
    

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</body>
</html>



