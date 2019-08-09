
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../public/dist/img/informaticatributos.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <?php echo '<p>'.$_SESSION["username"].'</p>' ?>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="search" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU NAVEGACION</li>
  
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Menu</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">3</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="dashboard.php"><i class="fa fa-list-alt"></i> Tablero</a></li>
            <li><a href="empleados_dashboard.php"><i class="fa fa-users"></i> Administrar Empleado</a></li>
            <li><a href="cargar_excel.php"><i class="fa fa-cloud-upload"></i> Cargar Excel</a></li>
            <li><a href="accountsettings.php"><i class="fa fa-gear"></i> Cambiar Contraseña</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>