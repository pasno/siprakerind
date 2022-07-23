<?php
	$server="localhost"; //Nama server default xampp tersebut biasanya localhost
	$username="root"; //Nama root ini biasanya default dari xampp tersebut
	$password=""; //Isikan password jika diminta password pada halam awal ke localshost/phpmyadmin kalau tidak ada biarkan saja
	$db="db_prakerin"; //Sesuaikan dengan nama database yang anda sudah buat
	 
	$konek = mysqli_connect($server,$username,$password, $db) or die ("Gagal");
	date_default_timezone_set("Asia/Jakarta");
?>