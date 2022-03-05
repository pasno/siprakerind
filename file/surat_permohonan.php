<?php
$id_siswa = $_GET['siswa'];

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
$pdf->SetFont('Times','',12);
// $pdf->ln(2);
$pdf->Cell(100,6,'',0,0,'L');
$pdf->Cell(70,6,'Bangkalan, '.$tanggalfull,0,1,'L');
$pdf->Ln(1.5);
$pdf->Cell(100,6,'No. :             / SMK Al Hikam /          / '.$tahun,0,0,'L');
$pdf->Cell(70,6,'Kepada Yth :',0,1,'L');
$pdf->Cell(100,6,'Hal : Permohonan Praktek Kerja Industri',0,0,'L');
$pdf->SetFont('Times','B',12);
$pdf->Cell(70,6,'Pimpinan/Direktur',0,1,'L');
$pdf->Cell(100,6,'',0,0,'L');

$data = mysql_query("SELECT * FROM du_di, usulan_dudi WHERE du_di.id_du_di = usulan_dudi.id_du_di AND usulan_dudi.id_siswa = '$id_siswa'");
$a = mysql_fetch_array($data);
$pdf->Cell(70,6,$a['nama_du_di'],0,1,'L');
$pdf->Cell(100,6,'',0,0,'L');
$pdf->SetFont('');
$pdf->Cell(70,6,$a['alamat'],0,1,'L');

$pdf->Cell(100,6,'',0,0,'L');
$pdf->Cell(70,6,'Di',0,1,'L');
$pdf->SetFont('Times','BU',12);
$pdf->Cell(100,6,'',0,0,'L');
$pdf->Cell(70,6,'TEMPAT',0,1,'C');
$pdf->ln(4);
$pdf->SetFont('Times','I',12);
$pdf->Cell(170,6,'Assalamu\'alaikum Warahmatullahi Wabarakatuh',0,1);
$pdf->SetFont('');
$pdf->Ln(1.5);
$pdf->Cell(170,6,'Dengan Hormat,',0,1);
$pdf->Ln(1.5);
$pdf->MultiCell(173,6,'Dalam penyelenggaraan Pendidikan Sistem Ganda (PSG), disamping siswa melaksanakan Kegiatan Belajar Mengajar (KBM) di sekolah, siswa dituntut melaksanakan KBM di Dunia Usaha/ Dunia Industri, yang dikenal dengan istilah Prakerin (Praktek Kerja Indurstri).',0,'J',0);
$pdf->Ln(1.5);
$pdf->MultiCell(173,6,'Untuk memenuhi pelaksanaan prakerin di DU/DI tersebut, kami mohon Bapak/Ibu pimpinan '. $a['nama_du_di'] .' berkenan menerima siswa kami melaksanakan Prakerin di DU/DI Bapak/Ibu, dengan peserta seperti pada tabel di bawah ini :',0,'J',0);
$pdf->Ln(1.5);
$kueri = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$id_siswa'");
$b = mysql_fetch_array($kueri);
$pdf->Cell(170,6,'Kompetensi Keahlian : '.$b['program_keahlian'],0,1);
$pdf->Ln(2);
$pdf->Cell(13,6,'No',1,0,'C');
$pdf->Cell(60,6,'Nama',1,0,'C');
$pdf->Cell(50,6,'NISN',1,0,'C');
$pdf->Cell(50,6,'Kelas/Semester',1,1,'C');
$i=1;
$kueri1 = mysql_query("SELECT * FROM siswa, usulan_dudi WHERE siswa.id_siswa = usulan_dudi.id_siswa AND usulan_dudi.status = 'acc' AND usulan_dudi.id_du_di='$a[id_du_di]' AND siswa.tahun_pelajaran='$b[tahun_pelajaran]'");
while ( $c = mysql_fetch_array($kueri1)) {
	$pdf->Cell(13,6,$i,1,0,'C');
	$pdf->Cell(60,6,$c['nama_siswa'],1,0);
	$pdf->Cell(50,6,$c['id_siswa'],1,0,'C');
	if (substr($c['tahun_pelajaran'], 21, 1)=='1') {
		$kelas = 'XI/3';
	} else if (substr($c['tahun_pelajaran'], 21, 1)=='2') {
		$kelas = 'XI/4';
	}
	$pdf->Cell(50,6,$kelas,1,1,'C');
	$i++;
}
$pdf->Ln(3.5);
$pdf->MultiCell(173,6,'Selain itu kami mengharapkan adanya kerjasama dan informasi tentang waktu dan lama pelaksanaan prakerin pada perusahaan Bapak/Ibu, dan apabila berkenan dapat dilaksanakan mulai tanggal {tanggal mulai } sampai dengan {tanggal selesai}.',0,'J',0);
$pdf->Ln(1.5);
$pdf->MultiCell(173,6,'Akhirnya informasi  dan balasan dari Bapak/Ibu kami tunggu. Atas perhatian dan berkenannya permohonan ini, sebelumnya disampaikan terimakasih.',0,'J',0);
$pdf->ln(1.5);
$pdf->SetFont('Times','I',12);
$pdf->Cell(170,6,'Wassalamu\'alaikum Warahmatullahi Wabarakatuh',0,1);
$pdf->ln(4.5);
$pdf->SetFont('');
$pdf->Cell(95,6,'',0,0,'C');
$pdf->Cell(80,6,'Hormat Kami,',0,1,'L');
$pdf->Cell(95,6,'',0,0,'C');
$pdf->Cell(80,6,'Kepala SMK Al Hikam',0,1,'L');
$pdf->ln(20);
$pdf->Cell(85,6,'',0,0,'C');
$pdf->Cell(80,6,'Drs. H. Muhdhori A.R M.Pd.I.',0,1,'C');
// $pdf->SetFont('');
// $pdf->Cell(85,6,'',0,0,'C');
// $pdf->Cell(80,6,'NIP. xxxxxxx',0,1,'C');

$pdf->SetTitle('Pengumuman Pendaftaran Seminar Proposal');

$pdf->Output();
ob_end_flush();
?>