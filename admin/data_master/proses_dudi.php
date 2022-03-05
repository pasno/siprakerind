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
			    $foto = $_FILES['foto_dudi'];
	      		$fotoname = $_FILES['foto_dudi']['name'];
	      		$fototype = $_FILES['foto_dudi']['type'];
	      		$fototmp_name = $_FILES['foto_dudi']['tmp_name'];
	      		$fotosize = $_FILES['foto_dudi']['size'];
	      		$fotoerror = $_FILES['foto_dudi']['error'];

	      		$fotoext = explode('.', $fotoname);
	      		$fotoactualext = strtolower(end($fotoext));
	      		$fotonewname = $_POST['id_du_di'] . '.' . $fotoactualext;
	      		$fotodestination = '../../gambar/foto/'.$fotonewname;

	      		move_uploaded_file($fototmp_name, $fotodestination);
			    mysql_query("INSERT INTO du_di VALUES ('$_POST[id_du_di]','$_POST[nama_du_di]','$_POST[bidang_usaha]','$_POST[nama_pimpinan]','$_POST[nama_pembimbing]','$_POST[alamat]','$fotodestination')") or die(mysql_error());
			    mysql_query("INSERT INTO user VALUES ('$_POST[id_du_di]','$_POST[id_du_di]','DUDI')") or die(mysql_error());			    
			    echo '<script>window.location="../../index.php?admin&p=dudi"</script>';
	            break;
	        case "update":
	        	$foto = $_FILES['foto_dudi'];
	      		$fotoname = $_FILES['foto_dudi']['name'];
	      		$fototype = $_FILES['foto_dudi']['type'];
	      		$fototmp_name = $_FILES['foto_dudi']['tmp_name'];
	      		$fotosize = $_FILES['foto_dudi']['size'];
	      		$fotoerror = $_FILES['foto_dudi']['error'];
		        if ($fototmp_name != null) {
		      		$fotoext = explode('.', $fotoname);
		      		$fotoactualext = strtolower(end($fotoext));
		      		$fotonewname = $_POST['id_du_di'] . '.' . $fotoactualext;
		      		$fotodestination = '../../gambar/foto/'.$fotonewname;
		      		move_uploaded_file($fototmp_name, $fotodestination);
		      		mysql_query("UPDATE du_di SET foto = '$fotodestination'");
		        }
			    mysql_query("UPDATE du_di SET nama_du_di='$_POST[nama_du_di]',bidang_usaha='$_POST[bidang_usaha]', nama_pimpinan='$_POST[nama_pimpinan]',nama_pembimbing='$_POST[nama_pembimbing]',alamat = '$_POST[alamat]' WHERE id_du_di='$_POST[id_du_di]'");
			    mysql_query("UPDATE user set password='$_POST[password]'WHERE id_user = '$_POST[id_du_di]'");
			    $_SESSION['pesan'] = "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Data berhasil di Update... !!</div></div>";
			    echo '<script>window.location="../../index.php?admin&p=dudi"</script>';
			    break;
	        case "hapus":
			    $sql = mysql_query("select * FROM du_di WHERE id_du_di='$_GET[id]'");
	        	$hasil = mysql_fetch_array($sql);
	        	$foto = $hasil['foto'];
	        	unlink($foto);

			    mysql_query("DELETE FROM du_di WHERE id_du_di='$_GET[id]'");
			    mysql_query("DELETE FROM user WHERE id_user='$_GET[id]'");
			    $_SESSION['pesan'] = "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Data berhasil di Hapus... !!</div></div>";
			    echo '<script>window.location="../../index.php?admin&p=dudi"</script>';
	  	        break;
	  	}
?>     