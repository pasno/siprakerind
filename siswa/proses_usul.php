<?php
$sql = mysql_query("SELECT * FROM du_di WHERE nama_du_di = '$_POST[nama_du_di]'");
$num = mysql_num_rows($sql);
$hasil = mysql_fetch_array($sql);
// echo $_POST['nama_du_di']. '<br>';
if ($num == 0) {
	$id_du_di = strtolower(preg_replace('/\s/', '', $_POST['nama_du_di']));
	mysql_query("INSERT INTO du_di VALUES ('$id_du_di', '$_POST[nama_du_di]','$_POST[bidang_usaha]','$_POST[nama_pimpinan]','','$_POST[alamat]','')")or die(mysql_error());
} else {
	$id_du_di = $hasil['id_du_di'];
}

mysql_query("INSERT INTO usulan_dudi VALUES ('', '$_SESSION[username]','$id_du_di','belum acc')")or die(mysql_error());
echo '<script>window.location="index.php?siswa&p=usulkan"</script>';
?>