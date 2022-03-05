<?php
if (strtolower($_SESSION['level'])=='siswa') {
  $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa='$_SESSION[username]'");
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
                  $tp=mysql_query("SELECT * FROM tabel_absen WHERE id_siswa='$_SESSION[username]'");
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