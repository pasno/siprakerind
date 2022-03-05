<?php
if (strtolower($_SESSION['level'])=='admin') {
  ?>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Absen Siswa Praktek Kerja Industri</h3>
        </div>
        <!-- /.box-header -->
        <hr>
        <div style="padding-left: 11px;" class="form-inline">
          <form action="" method="post">
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
              echo '<script>window.location="index.php?admin&p=cek_absen&s='.$seleksitahun.'"</script>';
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
                <th>Alamat DU/DI</th>
                <th>Tools</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i=1;
              if ((isset($_GET['s'])) and ($_GET['s']!=''))  {
                  $s = $_GET['s'];
                  // echo $s.'<br>';
                  // echo substr($s, 0, 9).'<br>';
                  // echo substr($s, 9, 10).'<br>';
                  // echo substr($s, 19, 2).'<br>';
                  $ss = substr($s, 0, 9).' '.substr($s, 9, 10).' '.substr($s, 19, 2);
                  $tp=mysql_query("SELECT * FROM siswa, usulan_dudi, du_di WHERE siswa.id_siswa = usulan_dudi.id_siswa AND du_di.id_du_di = usulan_dudi.id_du_di AND siswa.tahun_pelajaran='$ss'");
                } else {
                  $tp=mysql_query("SELECT * FROM siswa, usulan_dudi, du_di WHERE siswa.id_siswa = usulan_dudi.id_siswa AND du_di.id_du_di = usulan_dudi.id_du_di");
                } 
                while($r=mysql_fetch_array($tp)){
                ?>                
                <tr> 
                  <td><?php echo $i;?></td>
                  <td><?php echo $r['nama_siswa'];?></td>
                  <td><?php echo $r['program_keahlian'];?></td>
                  <td><?php echo $r['nama_du_di'];?></td>
                  <td><?php echo $r['alamat'];?></td>
                  <td>
                    <a class= 'btn btn-primary' href="?admin&p=cek_absen_lanjut&siswa=<?php echo $r['id_siswa']?>"> <i class='fa fa-television '></i>Absen</a>
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
<?php
}else{
  echo "Akses Ditolak";
}
?>