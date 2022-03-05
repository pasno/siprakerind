<?php
session_start();

require_once ('koneksi.php');
function antiinjection($data){
  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter_sql;
}

$user = antiinjection($_POST['username']);
// $pass = antiinjection(md5($_POST['password']));
$pass = antiinjection($_POST['password']);

// echo $user .'-'. $pass . '<br>';

$sql = "SELECT * FROM user WHERE id_user = '$user'";

// echo $sql . '<br>';

$cekuser = mysql_query($sql);
$jumlah = mysql_num_rows($cekuser);
$hasil = mysql_fetch_array($cekuser);

// echo $hasil['password']. '<br>';
// echo $jumlah. '<br>';

if ( $jumlah == 0 ) {
	header('location:login.php?userfail');
} else {
    if ( $pass != $hasil['password'] ) {
		header('location:login.php?passwordfail');
    } else {
        $_SESSION['username'] = $user;
        $level = $hasil['level'];
        $_SESSION['level'] = $level;
        echo 'session : '.$_SESSION['username'];
        echo '<br>level : '.$level;
        if ($level=='Admin') {
            // echo 'cocok';
        	header('location:index.php?admin');
            //echo '<meta http-equiv="refresh" content="0; url=index.php?admin">';
        }
        else if ($level=='Siswa') {
        	header('location:index.php?siswa');
        }
        else if ($level=='Guru') {
        	header('location:index.php?guru');
        }
        else {
        	header('location:index.php?dudi');
    	}
    }
}
?>