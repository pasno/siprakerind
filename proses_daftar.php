<?php
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

$waktu = date('d-m-y H:i:s');
if (isset($_POST['nis'])) {
	$niss = $_POST['nis'];
}
if (isset($_POST['username'])) {
	$usernames = $_POST['username'];
}
if (isset($_POST['password'])) {
	$password = $_POST['password'];
}
if (isset($_POST['password1'])) {
	$password1 = $_POST['password1'];
}
// $passwords = md5($_POST['password']);
$levels = "Siswa";
$actives = "0";
if(($niss != NULL) && ($usernames != NULL) && ($password != NULL) && ($password1 != NULL)){
	if($password == $password1){
		$kueri = mysql_query("INSERT INTO user VALUES( NULL, '$niss', '$usernames', '$password', '$levels', '$waktu', '$actives')") or die(mysql_error());
	} else {
		echo "passsword harus sama";
	}
} else {
	echo "data tidak boleh kosong";
}


if($kueri){
	ech
	}

?>