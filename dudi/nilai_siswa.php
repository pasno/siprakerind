<?php
if (strtolower($_SESSION['level'])=='dudi') {
?>
   <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Nilai Siswa Praktek Kerja Industri</h3>
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
              echo '<script>window.location="index.php?admin&p=data_siswa&s='.$seleksitahun.'"</script>';
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
                <th>Tempat/Tanggal Lahir</th>
                <th>Program Keahlian</th>
                <th>Alamat</th>
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
                  $tp=mysql_query("SELECT * FROM siswa, usulan_dudi WHERE siswa.id_siswa = usulan_dudi.id_siswa AND usulan_dudi.id_du_di='$_SESSION[username]' AND siswa.tahun_pelajaran='$ss'");
                } else {
                  $tp=mysql_query("SELECT * FROM siswa, usulan_dudi WHERE siswa.id_siswa = usulan_dudi.id_siswa AND usulan_dudi.id_du_di='$_SESSION[username]' AND status = 'acc'");
                }
              // $tp=mysql_query("SELECT * FROM siswa, usulan_dudi WHERE siswa.id_siswa = usulan_dudi.id_siswa AND usulan_dudi.id_du_di='$_SESSION[username]' AND status = 'acc'");
              while($r=mysql_fetch_array($tp)){
                ?>                
                <tr> 
                  <td><?php echo $i;?></td>
                  <td><?php echo $r['nama_siswa'];?></td>
                  <td><?php echo $r['tempat_lahir']."/".$r['tanggal_lahir'];?></td>
                  <td><?php echo $r['program_keahlian'];?></td>
                  <td><?php echo $r['Alamat'];?></td>
                  <td>
                  <?php
                  $cek = mysql_query("SELECT * FROM nilai WHERE id_siswa='$r[id_siswa]'");
                  $b = mysql_num_rows($cek);
                  if ($b == 0) {?>
                    <a class= 'btn btn-primary' href="?dudi&p=proses_nilai&siswa=<?php echo $r['id_siswa']?>"> <i class='fa fa-television '></i> Nilai Siswa</a>
                  <?php
                  }else{
                  ?>
                    <a class= 'btn btn-success' href="?dudi&p=proses_nilai&siswa=<?php echo $r['id_siswa']?>"> <i class='fa fa-television '></i> Nilai Siswa</a>
                  <?php
                  }
                   ?>                                      
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