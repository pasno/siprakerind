<?php
if (strtolower($_SESSION['level'])=='siswa') {
  $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa='$_SESSION[username]'");
  $data = mysql_fetch_array($siswa);
  ?>
  <div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class='panel-title'><i class='fa fa-list'></i>Jurnal Kegiatan</h3>
          <hr>
          Nama : <?php echo $data['nama_siswa']?><br>
          Nama : <?php echo $data['program_keahlian']?>

          <hr>
          <?php
                date_default_timezone_set('Asia/Jakarta');
                $waktu = date('Y-m-d');
                $sql = mysql_query("SELECT * FROM tabel_absen,tabel_jurnal 
                                             WHERE tabel_absen.id_siswa='$_SESSION[username]' 
                                             AND tabel_absen.id = tabel_jurnal.id 
                                             AND tabel_absen.tanggal='$waktu'");
                $hasil = mysql_num_rows($sql);
                if ($hasil==0) {
                  ?>
                    <button type='button' class='btn btn-primary' data-toggle="modal" data-target="#modal-default"> <i class='fa fa-user-plus'></i>Klik untuk Memasukkan Kegiatan
                    </button>
                  <?php
                } else {
                  ?>
                    <button type='button' class='btn btn-primary' disabled="" data-toggle="modal" data-target="#modal-default"> <i class='fa fa-user-plus'></i>Sudah Memasukkan Kegiatan
                    </button>
                  <?php
                }
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
                <th>Jenis Kegiatan</th>
                <th>Uraian Kegiatan</th>
                <th>Tools</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i=1;
              $tp=mysql_query("SELECT * FROM tabel_absen, tabel_jurnal 
                                        WHERE tabel_absen.id=tabel_jurnal.id 
                                        AND id_siswa = '$_SESSION[username]'");
              while($r=mysql_fetch_array($tp)){
                ?>
                <tr> 
                  <td><?php echo $i;?></td>
                  <td><?php echo $r['tanggal'];?></td>
                  <td><?php echo$r['jam_masuk'];?></td>
                  <td><?php echo$r['jam_keluar'];?></td>
                  <td><?php echo$r['jenis_kegiatan'];?></td>
                  <td><?php echo$r['uraian_kegiatan'];?></td>
                  <td>
                    <a href="?p=hapus_jurnal&id_jurnal=<?php echo $r['id_jurnal']?> " name ='hapus' class="btn btn-danger">Hapus</a>
                  </td>
                </tr>
                <?php
                $i++;
                 } ?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Tambahkan Jurnal Kegiatan Siswa</h4>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                <div class="form-group has-feedback">
                  <input type="text" name="jenis_kegiatan" class="form-control" placeholder="Masukkan Jenis Kegiatan">
                </div>
                <div class="form-group has-feedback">
                  <textarea name="uraian_kegiatan" class="form-control" placeholder="Masukkan Uraian Kegiatan"></textarea> 
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                  <button name = 'simpan' type="submit" class="btn btn-primary">Simpan</button>
                </form>
                <?php
                $sql2 = mysql_query("SELECT * FROM tabel_absen WHERE id_siswa='$_SESSION[username]' AND tanggal='$waktu'");
                $hasil2 = mysql_fetch_array($sql2);
                $kets = $hasil2['keterangan'];
                echo $kets;
                if (isset($_POST['simpan'])){
                  if ($kets=='Masuk') {                
                    echo $_POST['jenis_kegiatan'].'<br>';
                    echo $_POST['uraian_kegiatan'].'<br>';
                    date_timezone_set('Asia/Jakarta');
                    $tanggal = date("Y-m-d");
                    $query = mysql_query("SELECT * FROM tabel_absen WHERE id_siswa='$_SESSION[username]'AND tanggal= '$tanggal'");
                    $hasilquery = mysql_fetch_array($query);
                    $idabsen = $hasilquery['id'];
                    mysql_query("INSERT INTO tabel_jurnal VAlUES ('','$idabsen','$_POST[jenis_kegiatan]','$_POST[uraian_kegiatan]')");
                    echo '<script>window.location="index.php?siswa&p=jurnal"</script>';                  
                  } else {
                    ?>
                    <script type="text/javascript">
                      confirm('Hari Ini, Anda Belum Diabsen oleh DU/DI');
                    </script>
                    <script>window.location="index.php?siswa&p=jurnal"</script>;
                    <?php
                  }

                }
                ?>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <?php
      }else{
        echo "Akses Ditolak";
      }
      ?>