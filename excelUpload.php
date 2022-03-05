<?php
require('importxls/php-excel-reader/excel_reader2.php');
require('importxls/SpreadsheetReader.php');
require "config/+koneksi.php";
if(isset($_POST['Submit']))
{
$mimes = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.oasis.opendocument.spreadsheet'];
if(in_array($_FILES["fileImport"]["type"],$mimes))
{
$uploadFilePath = 'file/'.basename($_FILES['fileImport']['name']);

move_uploaded_file($_FILES['fileImport']['tmp_name'], $uploadFilePath);
$Reader = new SpreadsheetReader($uploadFilePath);

$totalSheet = count($Reader->sheets());
echo "You have total ".$totalSheet." sheets".

$html="<table border='1'>";

/* For Loop for all sheets */
for($i=0;$i<$totalSheet;$i++)
{
$Reader->ChangeSheet($i);
foreach ($Reader as $Row)
{
$html.="<tr>";
$id = isset($Row[0]) ? $Row[0] : '';
$level = isset($Row[1]) ? $Row[1] : '';
$nama = isset($Row[2]) ? $Row[2] : '';
if ($level=='Mahasiswa') {
	$dowal = isset($Row[3]) ? $Row[3] : '';
} else {
	$dowal = "";
}


if (($id != "ID") and ($id != "id") and ($id != "Id")) {
	$cek = "SELECT * FROM user WHERE id='$id'";
	$myQry = mysqli_query($koneksiDb,$cek) or die ("Gagal Query1" .mysql_error());
	$num = mysqli_num_rows($myQry);
	if ($num == 0) {
		$query = "insert into user values('".$id."','".$id."','".$level."')";
		$myQry = mysqli_query($koneksiDb,$query) or die ("Gagal Query1" .mysql_error());
		 
		if ($level == "Mahasiswa") {
			$query1 = "insert into mahasiswa values('".$id."','".$nama."','".$dowal."')";
		} elseif ($level == "Dosen") {
			$query1 = "insert into dosen values('".$id."','".$nama."')";
		} elseif ($level == "Admin") {
			$query1 = "insert into admin values('".$id."','".$nama."')";
		}
		$myQry = mysqli_query($koneksiDb,$query1) or die ("Gagal Query1" .mysql_error());

		$html.="<td>".$id."</td>";
		$html.="<td>".$level."</td>";
		$html.="<td>".$nama."</td>";
		$html.="<td>".$dowal."</td>";
		$html.="</tr>";
	}
}

}
}
$html.="</table>";

//echo"<meta http-equiv='refresh' content='0; url=?Open=User-View'>";
echo $num;
echo $html;
}
else
{
die("<br/>Sorry, File type is not allowed. Only Excel file.");
}
}
?>