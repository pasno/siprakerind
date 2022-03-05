<?php 
session_start();

if (!isset($_SESSION['username']) ) {
  header('location:login.php'); 
} else { 
  $usr = $_SESSION['username'];
}
require_once('koneksi.php');

$admin = isset($_GET['admin']);
$siswa = isset($_GET['siswa']);
$guru = isset($_GET['guru']);
$dudi = isset($_GET['dudi']);

$query = mysql_query("SELECT * FROM user WHERE id_user = '$usr'");
$hasil = mysql_fetch_array($query);

if (empty($hasil['id_user'])) {
  header('Location:login.php');
}

if($_SESSION['level']=='Admin'){
  $nama = 'Admin';
  $titel = '';
} else if ($_SESSION['level']=='Siswa'){
  $query = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$usr'");
  $hasil = mysql_fetch_array($query);
  $titel = $hasil['program_keahlian'];
  $nama = $hasil['nama_siswa'];
} else if ($_SESSION['level']=='Guru'){
  $query = mysql_query("SELECT * FROM guru WHERE id_guru = '$usr'");
  $hasil = mysql_fetch_array($query);
  $nama = $hasil['nama_guru'];
  $titel = 'Guru '.$hasil['status_jabatan'];
} else if ($_SESSION['level']=='DUDI'){
  $query = mysql_query("SELECT * FROM du_di WHERE id_du_di = '$usr'");
  $hasil = mysql_fetch_array($query);
  $nama = $hasil['nama_du_di'];
  $titel = $hasil['bidang_usaha'];
}  
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIPRAKERIN</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>SIPRAKERIN</b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->

            <!-- Notifications: style can be found in dropdown.less -->

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="assets/dist/img/user2-160x160.png" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $nama ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="assets/dist/img/user2-160x160.png" class="img-circle" alt="User Image">

                  <p>
                    <?php 
                    echo $nama;
                    ?>
                    <small><?php echo $titel;?></small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <!-- <a href="?siswa&p=usulkan"> -->
                    <?php 
                    if ($_SESSION['level']=='Admin') {
                      echo '
                      <a href="?admin&p=password" class="btn btn-default btn-flat">Ubah Password</a>
                      ';
                    }else if ($_SESSION['level']=='Siswa'){
                      echo '
                      <a href="?siswa&p=profil_siswa" class="btn btn-default btn-flat">Profile</a>                   
                      ';
                    }else if ($_SESSION['level']=='DUDI') {
                      echo '
                      <a href="?dudi&p=profil_dudi" class="btn btn-default btn-flat">Profile</a>                   
                      ';
                    }else{
                      echo '
                      <a href="?guru&p=profil_guru" class="btn btn-default btn-flat">Profile</a>                   
                      ';
                    }
                    ?>                 
                  </div>
                  <div class="pull-right">
                    <a href="logout.php" class="btn btn-default btn-flat">Log Out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->

          </ul>
        </div>
      </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <?php 
          if (strtolower($_SESSION['level'])=='admin') {
           ?>
           <li class="active">
            <a href="?admin&p=dashboard">
              <i class="fa fa-home"></i> <span>Dashboard</span>
            </a>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-folder"></i> <span>Data Master</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="?admin&p=siswa"><i class="fa fa-circle-o"></i> Siswa</a></li>
              <li><a href="?admin&p=guru"><i class="fa fa-circle-o"></i> Guru</a></li>
              <li><a href="?admin&p=dudi"><i class="fa fa-circle-o"></i> Dudi</a></li>
            </ul>
          </li>
          <li class="active">
            <a href="?admin&p=peta">
              <i class="fa fa-external-link"></i> <span>Pemetaan Siswa</span>
            </a>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-folder"></i> <span>Kelola Data Absen</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="?admin&p=cek_absen"><i class="fa fa-circle-o"></i> Data Absen Siswa</a></li>
              <li><a href="?admin&p=report_absen"><i class="fa fa-circle-o"></i> Report</a></li>
            </ul>
          </li>
          <li class="active">
            <a href="?admin&p=nilai">
              <i class="fa fa-line-chart"></i> <span>Laporan Nilai Siswa</span>
            </a>
          </li>
          <?php } ?>

          <?php 
          if (strtolower($_SESSION['level'])=='siswa') {
           ?>
           <li class="active">
            <a href="?siswa&p=dashboard">
              <i class="fa fa-home"></i> <span>Dashboard</span>
            </a>
          </li>
          <li class="active">
            <a href="?siswa&p=usulkan">
              <i class="fa fa-hand-lizard-o"></i> <span>Mengusulkan DUDI</span>
            </a>
          </li>
          <li class="active">
            <a href="?siswa&p=cek_absenku">
              <i class="fa fa-calendar"></i> <span>Cek Absen</span>
            </a>
          </li>
          <li class="active">
            <a href="?siswa&p=jurnal">
              <i class="fa  fa-newspaper-o"></i> <span>Jurnal Kegiatan Harian</span>
            </a>
          </li>
          <li class="active">
            <a href="?siswa&p=nilaiku">
              <i class="fa fa-dashboard"></i> <span>Cek Nilai</span>
            </a>
          </li>

          <?php } ?>

          <?php if (strtolower($_SESSION['level'])=='dudi') {
            ?>
            <li class="active">
              <a href="?dudi&p=dashboard">
                <i class="fa fa-home"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="active">
              <a href="?dudi&p=data_siswa">
                <i class="fa fa-calendar"></i> <span>Absen Siswa</span>
              </a>
            </li>
            <li class="active">
              <a href="?dudi&p=nilai_siswa">
                <i class="fa fa-dashboard"></i> <span>Nilai Siswa</span>
              </a>
            </li>
            <?php } ?>

            <?php if (strtolower($_SESSION['level'])=='guru') {
              ?>
              <li class="active">
                <a href="?guru&p=dashboard">
                  <i class="fa fa-home"></i> <span>Dashboard</span>
                </a>
              </li>
              <li class="active">
                <a href="?guru&p=list_bimbingan">
                  <i class="fa fa-calendar"></i> <span>Cek Absen Siswa</span>
                </a>
              </li>
              <li class="active">
                <a href="?guru&p=monitoring_siswa">
                  <i class="fa fa-feed"></i> <span>Monitoring Siswa</span>
                </a>
              </li>
              <li class="active">
                <a href="?guru&p=cek_nilai_siswa">
                  <i class="fa fa-dashboard"></i> <span>Cek Nilai Siswa</span>
                </a>
              </li>
              <?php } ?>



            </ul>
          </section>
          <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <!-- Main content -->
          <section class="content">
            <?php include "konten.php"; ?>
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
          <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
          </div>
          <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
          reserved.
        </footer>

        !-- ./wrapper -->

        <!-- jQuery 3 -->
        <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- DataTables -->
        <script src="assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="assets/bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="assets/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="assets/dist/js/demo.js"></script>
        <script>
          $(document).ready(function () {
            $('.sidebar-menu').tree()
          })
        </script>
        <!-- page script -->
        <script>
          $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
              'paging'      : true,
              'lengthChange': false,
              'searching'   : false,
              'ordering'    : true,
              'info'        : true,
              'autoWidth'   : false
            })
          })
        </script>
      </body>
      </html>