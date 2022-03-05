<?php
if (strtolower($_SESSION['level'])=='dudi') {
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
          if ($hasil==0) {
            ?>
            <button type='button' class='btn btn-primary' data-toggle="modal" data-target="#modal-default"> <i class='fa fa-user-plus'></i>Klik untuk Mengabsen Siswa
            </button>
            <?php
          } else {
            ?>
            <button type='button' class='btn btn-primary' disabled="" data-toggle="modal" data-target="#modal-default"> <i class='fa fa-user-plus'></i>Sudah Absen
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
                <th>Keterangan</th>
                <th>Tools</th>
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
                  <td>
                    <a href="?p=hapus_absen&dudi=<?php echo $_SESSION['username']?>&siswa=<?php echo $id_siswa?>&tanggal=<?php echo $r['tanggal']?>" name ='hapus' class="btn btn-danger"><i class='fa fa-trash-o '></i> Hapus</a>
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
            <h4 class="modal-title">Absen Siswa</h4>
          </div>
          <div class="modal-body">
            <form action="" method="post">            
              <div class="form-group has-feedback">
                <input type="time" name="jam_masuk" class="form-control" placeholder="Masukkan Jam Masuk">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input type="time" name="jam_pulang" class="form-control" placeholder="Masukkan Jam Pulang">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <select class="form-control" name="keterangan">
                  <option value="">Masukkan Keterangan Absen</option>
                  <option value="Masuk">Masuk</option>
                  <option value="Sakit">Sakit</option>
                  <option value="Izin">Izin</option>
                  <option value="Absen">Absen</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
              <button name = 'simpan' type="submit" class="btn btn-primary">Simpan</button>
            </form>
            <?php
            if (isset($_POST['simpan'])) {
              mysql_query("INSERT INTO tabel_absen VAlUES ('','$_SESSION[username]','$id_siswa','$waktu','$_POST[keterangan]','$_POST[jam_masuk]','$_POST[jam_pulang]')");
              echo '<script>window.location="index.php?dudi&p=absen_siswa&siswa='.$id_siswa.'"</script>';
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