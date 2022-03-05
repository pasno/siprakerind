<?php
	$siswa = $_GET['s'];
	mysql_query("UPDATE usulan_dudi SET status='belum acc' WHERE id_siswa='$siswa'");
	mysql_query("DELETE FROM guru_pembimbing WHERE id_siswa='$siswa'");
	echo '<script>window.location="index.php?admin&p=peta"</script>';
?>