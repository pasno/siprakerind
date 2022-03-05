<?php
if (strtolower($_SESSION['level'])=='guru') {
  $id_siswa= $_GET['siswa'];
  $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa='$id_siswa'");
  $data = mysql_fetch_array($siswa);
?>
<div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Absensi Siswa</h3>
              <hr>
              Nama : <?php echo $data['nama_siswa']?><br>
              Nama : <?php echo $data['program_keahlian']?>
              
              <hr>
              <?php
                date_default_timezone_set('Asia/Jakarta');
                $waktu = date('Y-m-d');
                $sql = mysql_query("SELECT * FROM tabel_absen WHERE id_siswa='$id_siswa' AND id_du_di='$_SESSION[username]' AND tanggal='$waktu'");
                $hasil = mysql_num_rows($sql);
              ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Jam Masuk</th>
                  <th>Jam Pulang</th>
                  <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $i=1;
                  $tp=mysql_query("SELECT * FROM tabel_absen WHERE id_siswa='$id_siswa'");
                  while($r=mysql_fetch_array($tp)){
                ?>
                  <tr> 
                    <td><?php echo $i;?></td>
                    <td><?php echo $r['tanggal'];?></td>
                    <td><?php echo$r['jam_masuk'];?></td>
                    <td><?php echo$r['jam_keluar'];?></td>
                    <td><?php echo$r['keterangan'];?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
<?php
}else{
  echo "Akses Ditolak";
}
?>        