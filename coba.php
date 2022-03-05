<?php
$server="localhost"; //Nama server default xampp tersebut biasanya localhost
	$konek="root"; //Nama root ini biasanya default dari xampp tersebut
	$password=""; //Isikan password jika diminta password pada halam awal ke localshost/phpmyadmin kalau tidak ada biarkan saja
	$db="test"; //Sesuaikan dengan nama database yang anda sudah buat
	 
	$konek = mysql_connect($server,$konek,$password) or die (mysql_error());
	$database = mysql_select_db($db);


	$sql = "SELECT * FROM siswa";
	$hasil = mysql_query($sql);

	while ($row = mysql_fetch_assoc($hasil)) {
		echo $row['nama']." <img src=\"assets/img/demo/".$row['foto']."\"><br>";
	}




 ?>