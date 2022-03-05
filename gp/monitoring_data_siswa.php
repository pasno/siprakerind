<?php
if (strtolower($_SESSION['level'])=='guru') {
  ?>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Monitoring Siswa Praktek Kerja Industri</h3>
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
            echo '<script>window.location="index.php?guru&p=monitoring_siswa&s='.$seleksitahun.'"</script>';
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
                $ss = substr($s, 0, 9).' '.substr($s, 9, 10).' '.substr($s, 19, 2);
                $tp=mysql_query("SELECT * FROM siswa, usulan_dudi, guru_pembimbing, guru 
                                          WHERE siswa.id_siswa = guru_pembimbing.id_siswa 
                                          AND siswa.id_siswa = usulan_dudi.id_siswa 
                                          AND guru.id_guru = guru_pembimbing.id_guru
                                          AND usulan_dudi.status = 'acc' 
                                          AND siswa.tahun_pelajaran='$ss' 
                                          AND guru_pembimbing.id_guru = '$_SESSION[username]'");
              } else {
                $tp=mysql_query("SELECT * FROM siswa, guru, guru_pembimbing 
                                          WHERE siswa.id_siswa = guru_pembimbing.id_siswa 
                                          AND guru.id_guru=guru_pembimbing.id_guru 
                                          AND guru_pembimbing.id_guru = '$_SESSION[username]'");
              }
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
                    $ke = '';
                    $hitung = mysql_query("SELECT * FROM tabel_monitoring WHERE id_siswa = '$r[id_siswa]' AND id = '$r[id]'");
                    $hasilhitung = mysql_num_rows($hitung);
                    if ($hasilhitung == 0) {
                      $ke = 1;
                      ?>
                      <button class= 'btn btn-primary' data-toggle="modal" data-target="#modal-default_<?php echo $r['id_siswa']?>"><i class='fa fa-television '></i> Isi Monitoring</button>
                      <?php
                    } else if ($hasilhitung == 1) {
                      $ke = 2;
                      ?>
                      <button class= 'btn btn-primary' data-toggle="modal" data-target="#modal-default_<?php echo $r['id_siswa']?>"><i class='fa fa-television '></i> Isi Monitoring</button>
                      <?php
                    } else {
                      ?>
                      <button class= 'btn btn-primary' data-toggle="modal" data-target="#modal-default_<?php echo $r['id_siswa']?>" disabled><i class='fa fa-television '></i> Isi Monitoring</button>
                      <?php                        
                    }
                    ?>
                    <a class= 'btn btn-primary' href="?guru&p=hasil_monitoring&siswa=<?php echo $r['id_siswa']?>"> <i class='fa fa-info-circle '></i> Detail</a>

                    <!-- modal -->
                    <div class="modal fade" id="modal-default_<?php echo $r['id_siswa']?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">Monitoring Siswa <?php echo $r['nama_siswa']?> ke <?php echo $ke?></h4>
                            </div>
                            <div class="modal-body">
                              <form action="" method="post">
                                <table id="example1" class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>Uraian</th>
                                      <th>Pilihan</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php                  
                                    $i=1;
                                    $ts=mysql_query("SELECT * FROM tabel_aspek_monitoring");
                                    while($s=mysql_fetch_array($ts)){
                                      ?>
                                      <tr> 
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $s['uraian'];?></td>
                                        <td>
                                          <?php
                                          $sql2 = mysql_query("SELECT * FROM usulan_dudi WHERE id_siswa = '$r[id_siswa]'");
                                          $hasil2 = mysql_fetch_array($sql2);
                                          $id_du_di = $hasil2['id_du_di'];
                                          ?>
                                          <input type="hidden" name="id_du_di" value="<?php echo $id_du_di?>">
                                          <input type="hidden" name="id_siswa" value="<?php echo $r['id_siswa']?>">
                                          <input type="hidden" name="id" value="<?php echo $r['id']?>">
                                          <input type="hidden" name="ke" value="<?php echo $ke?>">
                                          <label class="radio-inline">
                                            <input type="radio" name="pilihan_<?php echo $r['id_siswa'].'_'.$i?>" value="Ya" > Ya
                                            <input type="radio" name="pilihan_<?php echo $r['id_siswa'].'_'.$i?>" value="Tidak" > Tidak                                                                 
                                          </label>                 
                                        </td>
                                      </tr>
                                      <?php 
                                      $i++;
                                    } 
                                    ?>
                                  </tbody>
                                </table>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                                <button name ="simpan_<?php echo $r['id_siswa']?>" type="submit" class="btn btn-primary">Simpan</button>
                              </form>
                              <?php
                              if (isset($_POST["simpan_".$r['id_siswa']])) {
                                  // $aspek = array('');
                                $sql = "INSERT INTO tabel_monitoring VAlUES ('', '$id_du_di', '$_POST[id_siswa]', '$_POST[id]', '$_POST[ke]'";                            
                                  for ($a=1; $a <= 10 ; $a++) { 
                                    // $aspek[$a] = $_POST["pilihan_".$r['id_siswa']."_".$a]."<br>";
                                    $sql = $sql .",'". $_POST["pilihan_".$r['id_siswa']."_".$a] ."'";
                                  }
                                  $sql = $sql.")";
                                  // echo $sql;
                                  mysql_query($sql);
                                  echo '<script>window.location="index.php?guru&p=monitoring_siswa"</script>';
                              }
                              ?>
                              </div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->          
<!-- akhir modal -->
</td>
</tr>
<?php 
$i++;
} 
?>
</tbody>
</table>
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->
</div>
<!-- /.col -->

<?php
}else {
  echo "Akses Ditolak";
}
?>