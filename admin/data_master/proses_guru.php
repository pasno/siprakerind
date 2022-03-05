<?php
session_start();
  	$timezone = "Asia/Jakarta";
	if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$date=date('Y-m-d');

		include "../../koneksi.php";
	  	$p = isset($_GET['act'])?$_GET['act']:null;
	  	switch($p){
	    	default:
	        break;
	      	case "input":						
			    $foto = $_FILES['foto_guru'];
	      		$fotoname = $_FILES['foto_guru']['name'];
	      		$fototype = $_FILES['foto_guru']['type'];
	      		$fototmp_name = $_FILES['foto_guru']['tmp_name'];
	      		$fotosize = $_FILES['foto_guru']['size'];
	      		$fotoerror = $_FILES['foto_guru']['error'];

	      		$fotoext = explode('.', $fotoname);
	      		$fotoactualext = strtolower(end($fotoext));
	      		$fotonewname = $_POST['id_guru'] . '.' . $fotoactualext;
	      		$fotodestination = '../../gambar/foto/'.$fotonewname;

	      		move_uploaded_file($fototmp_name, $fotodestination);
			    mysql_query("INSERT INTO guru VALUES ('$_POST[id_guru]','$_POST[nama_guru]','$_POST[tempat_lahir]','$_POST[tanggal_lahir]','$_POST[jk_guru]','$_POST[alamat_guru]','$_POST[status_jabatan]','$fotodestination')") or die(mysql_error());
			    mysql_query("INSERT INTO user VALUES ('$_POST[id_guru]','$_POST[id_guru]','Guru')") or die(mysql_error());			    
			    echo '<script>window.location="../../index.php?admin&p=guru"</script>';
	            break;
	        case "update":
	        	$foto = $_FILES['foto_guru'];
	      		$fotoname = $_FILES['foto_guru']['name'];
	      		$fototype = $_FILES['foto_guru']['type'];
	      		$fototmp_name = $_FILES['foto_guru']['tmp_name'];
	      		$fotosize = $_FILES['foto_guru']['size'];
	      		$fotoerror = $_FILES['foto_guru']['error'];
		        if ($fototmp_name != null) {
		      		$fotoext = explode('.', $fotoname);
		      		$fotoactualext = strtolower(end($fotoext));
		      		$fotonewname = $_POST['id_guru'] . '.' . $fotoactualext;
		      		$fotodestination = '../../gambar/foto/'.$fotonewname;
		      		move_uploaded_file($fototmp_name, $fotodestination);
		      		mysql_query("UPDATE guru SET foto = '$fotodestination'");
		        }
			    mysql_query("UPDATE guru SET nama_guru='$_POST[nama_guru]', tempat_lahir='$_POST[tempat_lahir]',tanggal_lahir='$_POST[tgl_lahir]',jk_guru = '$_POST[jk_guru]',alamat_guru = '$_POST[alamat_guru]',status_jabatan = '$_POST[status_jabatan]' WHERE id_guru='$_POST[id_guru]'");
			    mysql_query("UPDATE user set password='$_POST[password]'WHERE id_user = '$_POST[id_guru]'");
			    $_SESSION['pesan'] = "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Data berhasil di Update... !!</div></div>";
			    echo '<script>window.location="../../index.php?admin&p=guru"</script>';
			    break;
	        case "hapus":
	        	$sql = mysql_query("select * FROM guru WHERE id_guru='$_GET[id]'");
	        	$hasil = mysql_fetch_array($sql);
	        	$foto = $hasil['foto'];
	        	unlink($foto);

			    mysql_query("DELETE FROM guru WHERE id_guru='$_GET[id]'");
			    mysql_query("DELETE FROM user WHERE id_user='$_GET[id]'");
			    $_SESSION['pesan'] = "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Data berhasil di Hapus... !!</div></div>";
			    echo '<script>window.location="../../index.php?admin&p=guru"</script>';
	  	        break;
	  	}
?>     