<?php
	$dudi = $_GET['dudi'];
	$siswa = $_GET['siswa'];
	$tanggal = $_GET['tanggal'];

	mysql_query("DELETE FROM tabel_absen WHERE id_du_di='$dudi' AND id_siswa='$siswa' AND tanggal='$tanggal'");
	echo '<script>window.location="index.php?dudi&p=absen_siswa&siswa='.$siswa.'"</script>';
?>