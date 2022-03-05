<?php
	$id_nilai = $_GET['id_nilai'];
	$siswa = $_GET['siswa'];

	mysql_query("DELETE FROM nilai WHERE id_nilai = '$id_nilai'");
	echo '<script>window.location="index.php?dudi&p=proses_nilai&siswa='.$siswa.'"</script>';
?> 