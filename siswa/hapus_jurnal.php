<?php
	$id_jurnal = $_GET['id_jurnal'];

	mysql_query("DELETE FROM tabel_jurnal WHERE id_jurnal = $id_jurnal");
	echo '<script>window.location="index.php?siswa&p=jurnal"</script>';
?>