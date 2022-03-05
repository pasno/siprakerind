<?php
	$siswa = $_GET['s'];

	// $sql2 = mysql_query("SELECT * FROM guru");
	// while ($hasil2 = mysql_fetch_array($sql2)) {
	// 	$id_guru = $hasil2['id_guru'];
	// 	$sql3 = mysql_query("SELECT * FROM guru_pembimbing WHERE id_guru='$id_guru'");
	// 	$numguru = mysql_num_rows($sql3);
	// 	if ($numguru<) {
	// 		# code...
	// 	}
 	
	//  } 

	
	mysql_query("UPDATE usulan_dudi SET status='acc' WHERE id_siswa='$siswa'");
	
	$sql = mysql_query("SELECT * FROM usulan_dudi WHERE id_siswa='$siswa'");
	$hasil = mysql_fetch_array($sql);
	$id_du_di = $hasil['id_du_di'];

	$sql1 = mysql_query("SELECT * FROM user WHERE id_user='$id_du_di'");
	$num = mysql_num_rows($sql1);

	if ($num==0) {
		$sql1 = mysql_query("INSERT INTO user VALUES ('$id_du_di', '$id_du_di', 'DUDI')");
	}
	
	echo '<script>window.location="index.php?admin&p=peta"</script>';
?>