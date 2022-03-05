<?php
$p = isset($_GET['p'])?$_GET['p']:null;

switch($p){
    default:
        echo'<div class="panel panel-border panel-primary">
                <div class="panel-heading"> 
                    <h3 class="panel-title"><i class="fa fa-home"></i> Dashboard</h3> 
                </div> 
                <div class="panel-body"> 
                    <Center><h2><b>Hai '.$nama.', Selamat Datang di Sistem Informasi Prakerin </b></h2></center>
                    <center><h2><b>SMK AL Hikam<b/></h2></center>
                </div> 
            </div>';
        break;
    case "siswa":			
        include "admin/data_master/siswa.php";
        break;
    case "siswa_upload":           
        include "admin/data_master/upload_excel_siswa.php";
        break;
    case "guru":
        include "admin/data_master/guru.php";
        break;
    case "dudi":
        include "admin/data_master/dudi.php";
        break;
    case "peta":
        include "admin/pemetaan.php";
        break;
    case "cek_absen":
        include "admin/admin_data_absen_siswa.php";
        break;
    case "cek_absen_lanjut":
        include "admin/admin_data_absen_lanjut.php";
        break;    
    case "proses_acc":
        include "admin/proses_acc.php";
        break;
    case "proses_batal_acc":
        include "admin/proses_batal_acc.php";
        break;
    case "password":
        include "admin/password_edit.php";
        break;
    case "proses_edit_password":
        include "admin/password_proses_edit.php";
        break;
    case "nilai":
        include "admin/admin_nilai_siswa.php";
        break;
    case "report_absen":
        include "admin/report_absen.php";
        break;
    case "print_report_absen":
        include "admin/print_report_absen.php";
        break;
    case "usulkan":
        include "siswa/usul.php";
        break;
    case "proses_usul":
        include "siswa/proses_usul.php";
        break;
    case "profil_siswa":
        include "siswa/profil_siswa.php";
        break;
    case "proses_edit_siswa":
        include "siswa/proses_edit_siswa.php";
        break;
    case "data_dudi":
        include "siswa/data_dudi.php";
        break;
    case "cek_absenku":
        include "siswa/siswa_cek_absen.php";
        break;
    case "jurnal":
        include "siswa/jurnal_harian.php";
        break;
    case "hapus_jurnal":
        include "siswa/hapus_jurnal.php";
        break;
    case "nilaiku":
        include "siswa/nilai.php";
        break;
    case "profil_guru":
        include "gp/profil_gp.php";
        break;
    case "proses_edit_guru":
        include "gp/proses_edit_guru.php";
        break;
    case "list_bimbingan":
        include "gp/data_bimbing_siswa.php";
        break;
    case "list_bimbingan_lanjut":
        include "gp/data_bimbing_siswa_lanjut.php";
        break;
    case "monitoring_siswa":
        include "gp/monitoring_data_siswa.php";
        break;
    case "hasil_monitoring":
        include "gp/monitoring_hasil_input.php";
        break;
    case "cek_nilai_siswa":
        include "gp/guru_cek_nilai_siswa.php";
        break;
    case "profil_dudi":
        include "dudi/profil_du_di.php";
        break;
    case "proses_edit_dudi":
        include "dudi/proses_edit_dudi.php";
        break;
    case "data_siswa":
        include "dudi/data_siswa_magang.php";
        break;
    case "absen_siswa":
        include "dudi/absen_siswa.php";
        break;
    case "hapus_absen":           
        include "dudi/hapus_absen.php";
        break;
    case "nilai_siswa":           
        include "dudi/nilai_siswa.php";
        break;
    case "proses_nilai":           
        include "dudi/proses_nilai.php";
        break;
    case "hapus_nilai":           
        include "dudi/hapus_nilai.php";
        break;
}
?>
</body>
</html>