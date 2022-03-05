<?php
$s = str_replace('_', ' ', $_GET['s']);
$j = str_replace('_', ' ', $_GET['j']);

date_default_timezone_set('Asia/Jakarta');
include_once "../koneksi.php";

ob_start();
require('fpdf16/fpdf.php');
class PDF extends FPDF
{
//Page header
function Header()
{
	//Logo
	$this->Image('logo.jpg',10,10,35);
	//Times New Roman ordinary 14
	$this->SetFont('Times','B',14);
	//Move to the right
	$this->Cell(0,4,'YAYASAN PENDIDIKAN DAN SOSIAL',0,1,'C');
	$this->Ln(1.5);
	$this->Cell(0,4,'PONDOK PESANTREN AL-HIKAM',0,1,'C');
	$this->Ln(1.5);
	$this->Cell(0,4,'SMK AL-HIKAM',0,1,'C');
	$this->Ln(1.5);
	$this->Cell(0,4,'TERAKREDITASI B',0,1,'C');
	$this->Ln(1.5);
	$this->SetFont('Times','B',12);
	$this->Cell(0,4,'NSS : 322052903003; NIS : 400303; NPSN : 20551906',0,1,'C');
	$this->Ln(1.5);
	$this->Cell(0,4,'Jl. Raya Perumnas Tunjung No. 01 Burneh 69121',0,1,'C');
	$this->Ln(1.5);
	$this->Cell(0,4,'Telp. 031-309 1 555; Fax. 031-309 1 666; E-Mail : smk_alhikam@yahoo.co.id',0,1,'C');
	$this->Ln(1.5);
	$this->SetLineWidth(0.5);
	$this->Line(10,49,200,49);
	$this->SetLineWidth(0.2);
	$this->Line(10,49.8,200,49.8);
	$this->Ln(4);
}

//Page footer
function Footer()
{
	//Position at 1.5 cm from bottom
	$this->SetY(-15);
	//Arial italic 8
	$this->SetFont('Arial','I',8);
	//Page number
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

$date = date("d-m-Y");
$tanggal = substr($date, 0, 2);
$bulan = substr($date, 3, 2);
$tahun = substr($date, 6, 4);

switch ($bulan) {
	case '1':
		$bulan = 'Januari';
		break;
	case '2':
		$bulan = 'Februari';
		break;
	case '3':
		$bulan = 'Maret';
		break;
	case '4':
		$bulan = 'April';
		break;
	case '5':
		$bulan = 'Mei';
		break;
	case '6':
		$bulan = 'Juni';
		break;
	case '7':
		$bulan = 'Juli';
		break;
	case '8':
		$bulan = 'Agustus';
		break;
	case '9':
		$bulan = 'September';
		break;
	case '10':
		$bulan = 'Oktober';
		break;
	case '11':
		$bulan = 'November';
		break;
	case '12':
		$bulan = 'Desember';
		break;
}
$tanggalfull = $tanggal.' '.$bulan.' '.$tahun;

//Instanciation of inherited class
$pdf=new PDF();
$pdf->SetLeftMargin(20);
$pdf->AliasNbPages();
$pdf->AddPage('P', 'Legal');
$pdf->SetFont('Times','B',12);
$pdf->ln(4);
$pdf->Cell(170,6,"Data Nilai Jurusan ".$j.". Tahun pelajaran ".$s,0,1);
$pdf->ln(4);
$i=1;
$pdf->SetFont('Times','',12);
$pdf->Cell(7,6,'No',1,0,'C');
$pdf->Cell(60,6,'Nama',1,0);
$pdf->Cell(50,6,'Tempat Prakerin',1,0,'C');
$pdf->Cell(30,6,'Nilai Sikap',1,0);
$pdf->Cell(30,6,'Nilai Kinerja',1,1,'C');
// $pdf->Cell(30,6,'Jam Keluar',1,1,'C');
$data = mysql_query("SELECT * FROM siswa, du_di, nilai 
                                            WHERE siswa.id_siswa = nilai.id_siswa
                                            AND du_di.id_du_di = nilai.id_du_di 
                                            AND siswa.tahun_pelajaran='$s' 
                                            AND siswa.program_keahlian ='$j'");
while ( $a = mysql_fetch_array($data)) {
	$pdf->Cell(7,6,$i,1,0,'C');
	$pdf->Cell(60,6,$a['nama_siswa'],1,0);
	$pdf->Cell(50,6,$a['nama_du_di'],1,0,'C');
	$pdf->Cell(30,6,$a['nilai_kinerja'],1,0);
	$pdf->Cell(30,6,$a['nilai_sikap'],1,1,'C');
	// $pdf->Cell(30,6,$a['jam_keluar'],1,1,'C');
	$i++;
}
$pdf->Ln(3.5);
$pdf->Cell(95,6,'',0,0,'C');
$pdf->Cell(80,6,'Hormat Kami,',0,1,'L');
$pdf->Cell(95,6,'',0,0,'C');
$pdf->Cell(80,6,'Humas SMK Al Hikam',0,1,'L');
$pdf->ln(20);
$pdf->Cell(95,6,'',0,0,'C');
$pdf->Cell(80,6,'Risdiana Wijayanti, S.Pd.',0,1,'L');
// $pdf->SetFont('');
// $pdf->Cell(85,6,'',0,0,'C');
// $pdf->Cell(80,6,'NIP. xxxxxxx',0,1,'C');

$pdf->SetTitle('Nilai Prakerin Siswa');

$pdf->Output();
ob_end_flush();
?>