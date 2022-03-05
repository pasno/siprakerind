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
	      		$foto = $_FILES['foto_siswa'];
	      		$fotoname = $_FILES['foto_siswa']['name'];
	      		$fototype = $_FILES['foto_siswa']['type'];
	      		$fototmp_name = $_FILES['foto_siswa']['tmp_name'];
	      		$fotosize = $_FILES['foto_siswa']['size'];
	      		$fotoerror = $_FILES['foto_siswa']['error'];

	      		$fotoext = explode('.', $fotoname);
	      		$fotoactualext = strtolower(end($fotoext));
	      		$fotonewname = $_POST['nis'] . '.' . $fotoactualext;
	      		$fotodestination = '../../gambar/foto/'.$fotonewname;

	      		$tahun_gelombang = $_POST['tahun_pelajaran']." (".$_POST['gelombang'].")";
	      		move_uploaded_file($fototmp_name, $fotodestination);
			    mysql_query("INSERT INTO siswa VALUES ('$_POST[nis]','$_POST[nama]','$_POST[tempat_lahir]','$_POST[tgl_lahir]','$_POST[jk]','$_POST[alamat]','$_POST[jurusan]','$_POST[nama_ortu]','$_POST[status_pondok]','$fotodestination','$tahun_gelombang')") or die(mysql_error());
			    mysql_query("INSERT INTO user VALUES ('$_POST[nis]','$_POST[nis]','Siswa')") or die(mysql_error());			    
			    echo '<script>window.location="../../index.php?admin&p=siswa"</script>';
	            break;
	        case "update":
	        	$foto = $_FILES['foto_siswa'];
	      		$fotoname = $_FILES['foto_siswa']['name'];
	      		$fototype = $_FILES['foto_siswa']['type'];
	      		$fototmp_name = $_FILES['foto_siswa']['tmp_name'];
	      		$fotosize = $_FILES['foto_siswa']['size'];
	      		$fotoerror = $_FILES['foto_siswa']['error'];
		        if ($fototmp_name != null) {
		      		$fotoext = explode('.', $fotoname);
		      		$fotoactualext = strtolower(end($fotoext));
		      		$fotonewname = $_POST['nis'] . '.' . $fotoactualext;
		      		$fotodestination = '../../gambar/foto/'.$fotonewname;

		      		move_uploaded_file($fototmp_name, $fotodestination);
		      		mysql_query("UPDATE siswa SET foto = '$fotodestination'");
		        }
			    mysql_query("UPDATE siswa SET id_siswa='$_POST[nis]',nama_siswa='$_POST[nama]', tempat_lahir='$_POST[tempat_lahir]', tanggal_lahir='$_POST[tgl_lahir]', jk='$_POST[jk]', alamat='$_POST[alamat]', program_keahlian='$_POST[jurusan]', nama_ortu='$_POST[nama_ortu]', status_pondok='$_POST[status_pondok]', tahun_pelajaran = '$_POST[tahun_pelajaran]' WHERE id_siswa='$_POST[nis]'");
			    mysql_query("UPDATE user set password='$_POST[password]'WHERE id_user = '$_POST[nis]'");
			    $_SESSION['pesan'] = "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Data berhasil di Update... !!</div></div>";
			    echo '<script>window.location="../../index.php?admin&p=siswa"</script>';
			    break;
	        case "hapus":
	        	$sql = mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
	        	$hasil = mysql_fetch_array($sql);
	        	$foto = $hasil['foto'];
	    		unlink($foto);
		    	mysql_query("DELETE FROM siswa WHERE id_siswa='$_GET[id]'");
		    	mysql_query("DELETE FROM user WHERE id_user='$_GET[id]'");
		    	$_SESSION['pesan'] = "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Data berhasil di Hapus... !!</div></div>";
			    echo '<script>window.location="../../index.php?admin&p=siswa"</script>';
	  	        break;
	  	}
?>     