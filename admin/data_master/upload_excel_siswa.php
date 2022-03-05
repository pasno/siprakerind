<?php
require('importxls/php-excel-reader/excel_reader2.php');
require('importxls/SpreadsheetReader.php');
require "koneksi.php";

////////////////////////////////
$level = 'Siswa';
////////////////////////////////

if(isset($_POST['Submit']))
{
$mimes = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.oasis.opendocument.spreadsheet'];
if(in_array($_FILES["fileImport"]["type"],$mimes))
{
$uploadFilePath = 'file/'.basename($_FILES['fileImport']['name']);

move_uploaded_file($_FILES['fileImport']['tmp_name'], $uploadFilePath);
$Reader = new SpreadsheetReader($uploadFilePath);

$totalSheet = count($Reader->sheets());
echo "You have total ".$totalSheet." sheets";

/* For Loop for all sheets */
for($i=0;$i<$totalSheet;$i++)
{
	$Reader->ChangeSheet($i);
	foreach ($Reader as $Row)
	{
		$nis = isset($Row[0]) ? $Row[0] : '';
		$nama = isset($Row[1]) ? $Row[1] : '';
		$tempat_lahir = isset($Row[2]) ? $Row[2] : '';
		$tanggal_lahir = isset($Row[3]) ? $Row[3] : '';
		$jenis_kelamin = isset($Row[4]) ? $Row[4] : '';
		$alamat = isset($Row[5]) ? $Row[5] : '';
		$program_keahlian = isset($Row[6]) ? $Row[6] : '';
		$nama_orang_tua = isset($Row[7]) ? $Row[7] : '';
		$status_pondok = isset($Row[8]) ? $Row[8] : '';
		$tahun_pelajaran = isset($Row[9]) ? $Row[9] : '';
		$gelombang = isset($Row[10]) ? $Row[10] : '';
		$tahun_gelombang = $tahun_pelajaran." ".$gelombang;


		if (($nis != "NIS") and ($nis != "nis") and ($nis != "Nis")) {
			$cek = "SELECT * FROM user WHERE id_user='$nis'";
			$myQry = mysql_query($cek) or die ("Gagal Query1" .mysql_error());
			$num = mysql_num_rows($myQry);
			if ($num == 0) {
				$query = "insert into user values('".$nis."','".$nis."','".$level."')";
				$myQry = mysql_query($query) or die ("Gagal Query1" .mysql_error());
				
				$query1 = "INSERT INTO siswa VALUES ('$nis','$nama','$tempat_lahir','$tanggal_lahir','$jenis_kelamin','$alamat','$program_keahlian','$nama_orang_tua','$status_pondok','','$tahun_gelombang')";
				$myQry = mysql_query($query1) or die ("Gagal Query1" .mysql_error());
			}
		}

	}
}

// echo '<script>window.location="index.php?admin&p=siswa"</script>';
}
else
{
die("<br/>Sorry, File type is not allowed. Only Excel file.");
}
}
?>