<?php
if (strtolower($_SESSION['level'])=='guru') {
?>
   <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Nilai Prakerin Siswa</h3>
        </div>
        <!-- /.box-header -->
        <hr>
        <div class="form-inline">
          <form style="padding-left: 11px;" action="" method="post">
            <select style="height:34px;" class="custom-select" name="seleksitahun">
              <option value="">Tampilkan Data Menurut Tahun Ajaran </option>
              <?php
              $sql1= mysql_query("SELECT * FROM siswa");
              $tp1='';
              while ($hasil1=mysql_fetch_array($sql1)) {
                $tp=$hasil1['tahun_pelajaran'];
                if ($tp!=$tp1) {
                  
                  if (isset($_GET['s'])) {
                    $s = $_GET['s'];
                    if ((substr($s, 0, 9)==substr($tp, 0, 9)) and ((substr($s, 19, 1)==substr($tp, 21, 1)))) {
                      ?>
                        <option value="<?php echo $tp ?>" selected><?php echo $tp ?></option>
                      <?php
                    } else {
                      ?>
                        <option value="<?php echo $tp ?>"><?php echo $tp ?></option>
                      <?php
                    }
                  } else {
                      ?>
                        <option value="<?php echo $tp ?>"><?php echo $tp ?></option>
                      <?php
                  }

                }
                $tp1=$tp;
              }
            ?>
            </select>
              <button type="submit" value="cari" name="cari" class="btn btn-primary">Tampilkan</button>
          </form>
          <?php
            if (isset($_POST['cari'])) {
              $seleksitahun = strtolower(preg_replace('/\s/', '', $_POST['seleksitahun']));
              echo '<script>window.location="index.php?guru&p=cek_nilai_siswa&s='.$seleksitahun.'"</script>';
            }
          ?>
          </div>
          <hr>
          <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Program Keahlian</th>
                <th>Tempat Prakerin</th>
                <th>Nilai Sikap</th>
                <th>Nilai Kinerja</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i=1;
              if ((isset($_GET['s'])) and ($_GET['s']!=''))  {
                  $s = $_GET['s'];
                  $ss = substr($s, 0, 9).' '.substr($s, 9, 10).' '.substr($s, 19, 2);
                  $tp=mysql_query("SELECT siswa.nama_siswa, siswa.program_keahlian, du_di.nama_du_di,
                                          nilai.nilai_sikap,nilai.nilai_kinerja
                                           FROM siswa,nilai,du_di,guru_pembimbing 
                                           WHERE siswa.id_siswa = nilai.id_siswa 
                                           AND siswa.id_siswa = guru_pembimbing.id_siswa 
                                           AND du_di.id_du_di = nilai.id_du_di 
                                           AND siswa.tahun_pelajaran='$ss' 
                                           AND guru_pembimbing.id_guru = '$_SESSION[username]'");
                } else {
                  $tp=mysql_query("SELECT siswa.nama_siswa, siswa.program_keahlian, du_di.nama_du_di,
                                          nilai.nilai_sikap,nilai.nilai_kinerja
                                          FROM siswa,nilai,du_di,guru_pembimbing 
                                          WHERE siswa.id_siswa = nilai.id_siswa 
                                          AND siswa.id_siswa = guru_pembimbing.id_siswa 
                                          AND du_di.id_du_di = nilai.id_du_di 
                                          AND guru_pembimbing.id_guru = '$_SESSION[username]'");
                }
              while($r=mysql_fetch_array($tp)){
                ?>                
                <tr> 
                  <td><?php echo $i;?></td>
                  <td><?php echo $r['nama_siswa'];?></td>
                  <td><?php echo $r['program_keahlian'];?></td>
                  <td><?php echo $r['nama_du_di'];?></td>
                  <td><?php echo $r['nilai_sikap'];?></td>
                  <td><?php echo $r['nilai_kinerja'];?></td>
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
<?php
}else {
  echo "Akses Ditolak";
}
?>