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
              <h3 class="box-title">Data Hasil Monitoring Prakerin Siswa</h3>
              <br>
              <br>
              <br>              
              <table class="table">
                <tr>
                  <th>Nama</th>
                  <th>:</th>
                  <th><?php echo $data['nama_siswa']?></th>
                </tr>
                <tr>
                  <th>Jurusan</th>
                  <th>:</th>
                  <th><?php echo $data['program_keahlian']?></th>
                </tr>
              </table>
              <?php
                // date_default_timezone_set('Asia/Jakarta');
                // $waktu = date('Y-m-d');
                // $sql = mysql_query("SELECT * FROM tabel_absen WHERE id_siswa='$id_siswa' AND id_du_di='$_SESSION[username]' AND tanggal='$waktu'");
                // $hasil = mysql_num_rows($sql);
              ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="text-align: center; vertical-align: middle;" rowspan="2">No</th>
                  <th style="text-align: center; vertical-align: middle;" rowspan="2">Aspek</th>
                  <th style="text-align: center;" colspan="2">Monitoring</th>
                </tr>            
                <tr>
                  <th style="text-align: center; vertical-align: middle;">1</th>
                  <th style="text-align: center; vertical-align: middle;">2</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $sql1 = mysql_query("SELECT * FROM tabel_monitoring WHERE id_siswa = '$id_siswa' AND urutan_ke='I'");
                  $hasil1 = mysql_fetch_array($sql1);                
                  $sql2 = mysql_query("SELECT * FROM tabel_monitoring WHERE id_siswa = '$id_siswa' AND urutan_ke='II'");
                  $hasil2 = mysql_fetch_array($sql2);
                  $i=1;
                  $tp=mysql_query("SELECT * FROM tabel_aspek_monitoring");
                  while($r=mysql_fetch_array($tp)){
                ?>
                  <tr> 
                    <td><?php echo $i;?></td>
                    <td><?php echo $r['uraian'];?></td>
                    <td><?php echo $hasil1['aspek_'.$i];?></td>
                    <td><?php echo $hasil2['aspek_'.$i];?></td>
                  </tr>
                  <?php 
                  $i++;
                  } ?>
                  <tr> 
                    <td colspan="2"></td>
                    <td><button class="btn btn-primary" data-toggle="modal" data-target="#modal-default_1">EDIT</button></td>
                    <td><button class="btn btn-primary" data-toggle="modal" data-target="#modal-default_2">EDIT</button></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="modal fade" id="modal-default_1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Monitoring Siswa <?php echo $id_siswa?>ke 1</h4>
              </div>
              <?php
                $go = mysql_query("SELECT * FROM tabel_monitoring WHERE id_siswa = '$id_siswa' AND urutan_ke='I'");
                $d = mysql_fetch_array($go);
              ?>
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
                            $sql2 = mysql_query("SELECT * FROM usulan_dudi WHERE id_siswa = '$id_siswa'");
                            $hasil2 = mysql_fetch_array($sql2);
                            $id_du_di = $hasil2['id_du_di'];
                            ?>
                            <label class="radio-inline">                
                              <?php
                                if ($d['aspek_'.$i]=='Ya') {
                                  ?>
                                    <input type="radio" name="pilihan_<?php echo $i?>" value="Ya" checked> Ya
                                    <input type="radio" name="pilihan_<?php echo $i?>" value="Tidak" > Tidak                                                                 
                                  <?php
                                } elseif ($d['aspek_'.$i]=='Tidak') {
                                  ?>
                                    <input type="radio" name="pilihan_<?php echo $i?>" value="Ya"> Ya
                                    <input type="radio" name="pilihan_<?php echo $i?>" value="Tidak" checked> Tidak                                                                 
                                  <?php
                                }
                              ?>
                              
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
                  <button name ="simpan_1" type="submit" class="btn btn-primary">Simpan</button>
                </form>
                <?php
                  if (isset($_POST['simpan_1'])) {
                    $sql = "UPDATE tabel_monitoring SET ";                            
                    for ($a=1; $a <= 10 ; $a++) { 
                      $sql = $sql ."aspek_".$a."='". $_POST["pilihan_".$a] ."'";
                      if($a!=10){
                        $sql = $sql . ",";
                      }
                    }
                    $sql = $sql." WHERE id_siswa='$id_siswa' AND urutan_ke='I'";
                    // echo $sql;
                    mysql_query($sql);
                    echo '<script>window.location="index.php?gp&p=hasil_monitoring&siswa='.$id_siswa.'"</script>';
                  }
                ?>
                </div>
              </div>
            </div>
        </div>        
<!-- akhir modal -->

        <div class="modal fade" id="modal-default_2">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Monitoring Siswa <?php echo $id_siswa?>ke 2</h4>
              </div>
              <?php
                $go = mysql_query("SELECT * FROM tabel_monitoring WHERE id_siswa = '$id_siswa' AND urutan_ke='II'");
                $d = mysql_fetch_array($go);
              ?>
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
                            $sql2 = mysql_query("SELECT * FROM usulan_dudi WHERE id_siswa = '$id_siswa'");
                            $hasil2 = mysql_fetch_array($sql2);
                            $id_du_di = $hasil2['id_du_di'];
                            ?>
                            <label class="radio-inline">                
                              <?php
                                if ($d['aspek_'.$i]=='Ya') {
                                  ?>
                                    <input type="radio" name="pilihan_<?php echo $i?>" value="Ya" checked> Ya
                                    <input type="radio" name="pilihan_<?php echo $i?>" value="Tidak" > Tidak                                                                 
                                  <?php
                                } elseif ($d['aspek_'.$i]=='Tidak') {
                                  ?>
                                    <input type="radio" name="pilihan_<?php echo $i?>" value="Ya"> Ya
                                    <input type="radio" name="pilihan_<?php echo $i?>" value="Tidak" checked> Tidak                                                                 
                                  <?php
                                }
                              ?>
                              
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
                  <button name ="simpan_2" type="submit" class="btn btn-primary">Simpan</button>
                </form>
                <?php
                  if (isset($_POST['simpan_2'])) {
                    $sql = "UPDATE tabel_monitoring SET ";                            
                    for ($a=1; $a <= 10 ; $a++) { 
                      $sql = $sql ."aspek_".$a."='". $_POST["pilihan_".$a] ."'";
                      if($a!=10){
                        $sql = $sql . ",";
                      }
                    }
                    $sql = $sql." WHERE id_siswa='$id_siswa' AND urutan_ke='II'";
                    // echo $sql;
                    mysql_query($sql);
                    echo '<script>window.location="index.php?gp&p=hasil_monitoring&siswa='.$id_siswa.'"</script>';
                  }
                ?>
                </div>
              </div>
            </div>
        </div>        
<!-- akhir modal -->
<?php
}else{
  echo "Akses Ditolak";
}
?>        