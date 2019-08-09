<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Informatica-Tributos</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="public/img/icono.ico" type="image/x-icon" />
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="public/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="public/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="public/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="public/dist/css/AdminLTE.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="public/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<script type="text/javascript" src="public/js/jquery-3.3.1.js"></script> 
<style type="text/css">
	.login-page{
		background: url('public/img/Sky.jpg');
    --background-color: white;
		overflow: hidden;
	}
</style>
<body class="hold-transition login-page">
 
<div class="login-box">
  <div class="login-logo">
    <img src="public/img/infortributos_logo.png"  style="width: 350px;">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <form id="form-login"  enctype="application/x-www-urlencoded" autocomplete="off">
      <div class="form-group has-feedback">
        <input id="username" class="form-control" placeholder="Username" required>
        <span class=" form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input  id="password" type="password" class="form-control" placeholder="Password" required>
        <span class="form-control-feedback"></span>
      </div>
      
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox">Recordar Inicio se sesion
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-info btn-block btn-flat">Iniciar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>    
    <!-- /.social-auth-links -->
    <a href="#">Olvido su contraseña?</a><br>

    <div class="alert alert-info alert-dismissible" id="message_login" style="display: none">
                <button type="button" id="button-close" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <i class="icon fa fa-info"></i>
                 El nombre de usuario o  contraseña proporcionados son incorrectos.
    </div>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- Bootstrap 3.3.7 -->
<script type="text/javascript" src="views/js/login.js"></script>
<script src="public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="public/plugins/iCheck/icheck.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>