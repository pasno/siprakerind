<?php
if (strtolower($_SESSION['level'])=='admin') {
$maxbimbingan = 10;
?>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Usulan DUDI Siswa</h3>
        <br>
        <br>
      </div>
      <!-- /.box-header -->
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
          echo '<script>window.location="index.php?admin&p=siswa&s='.$seleksitahun.'"</script>';
        }
        ?>
      </div>
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nama Siswa</th>
              <th>Nama DUDI</th>
              <th>Alamat</th>
              <th>Status</th>
              <th>Tools</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $tp=mysql_query("select * from du_di, usulan_dudi, siswa WHERE du_di.id_du_di=usulan_dudi.id_du_di and siswa.id_siswa=usulan_dudi.id_siswa");
            while($r=mysql_fetch_array($tp)){
              ?>
              <tr> 
                <td><?php echo $r['nama_siswa'];?></td>
                <td><?php echo $r['nama_du_di'];?></td>
                <td><?php echo $r['alamat'];?></td>
                <td><?php echo $r['status'];?></td>
                <td>
                  <buttton type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo 'edit'.$r['id_siswa']?>">
                    EDIT
                  </buttton>
                  <?php
                  if ($r['status']=='acc') {
                    ?>
                    <buttton type="button" class="btn btn-danger" data-toggle="modal" data-target="#<?php echo 'batalacc'.$r['id_siswa']?>">
                      Batalkan ACC
                    </buttton>
                    <?php
                  } else {
                    ?>
                    <buttton type="button" class="btn btn-success" data-toggle="modal" data-target="#<?php echo 'acc'.$r['id_siswa']?>">
                      ACC
                    </buttton>
                    <?php
                  }
                  ?>
                </td>
              </tr>
              <div class="modal fade" id="<?php echo 'acc'.$r['id_siswa']?>">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">ACC</h4>
                      </div>
                      <div class="modal-body">
                        Untuk menyetujui, anda harus memilih guru pendamping untuk <?php echo $r['nama_siswa']?>.<br>
                        <form method="post" action="">
                          <select class="form-control" name="guru_pembimbing_<?php echo $r['id_siswa']?>" required>
                            <option value="">Pilih guru pendamping</option>
                            <?php
                            $sql2 = mysql_query("SELECT * FROM guru");
                            while ($hasil2 = mysql_fetch_array($sql2)) {
                             $id_guru = $hasil2['id_guru'];
                             $nama_guru = $hasil2['nama_guru'];
                             $bidang_ajar = $hasil2['status_jabatan'];
                             $sql3 = mysql_query("SELECT * FROM guru_pembimbing WHERE id_guru='$id_guru'");
                             $numguru = mysql_num_rows($sql3);
                             if ($numguru<$maxbimbingan) {
                               ?>
                               <option value="<?php echo $id_guru?>"><?php echo $nama_guru.' (Guru '.$bidang_ajar.')'?></option>
                               <?php
                             }
                             
                           } 
                           ?>
                         </select>
                         <hr>
                         Apakah anda menyetujui <?php echo $r['nama_siswa']?> untuk magang di <?php echo $r['nama_du_di']?>?
                       </div>
                       <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                        <!-- <a href="?admin&p=proses_acc&s=<?php// echo $r['id_siswa']?>" class="btn btn-primary">ACC</a> -->
                        <button value="submit" type="submit" name="acc_<?php echo $r['id_siswa']?>" class="btn btn-primary">ACC</button>
                      </form>
                      <?php
                      if (isset($_POST['acc_'.$r['id_siswa']])) {
                        $guru_pembimbing=$_POST['guru_pembimbing_'.$r['id_siswa']];
                           // echo '......'.$r['id_siswa'].'<br>';
                           // echo '......'.$_POST['acc_'.$r['id_siswa']].'<br>';
                           // echo '......'.$guru_pembimbing.'<br>';
                        mysql_query("UPDATE usulan_dudi SET status='acc' WHERE id_siswa='$r[id_siswa]'");
                        mysql_query("INSERT INTO guru_pembimbing VALUES ('', '$r[id_siswa]', '$guru_pembimbing')");
                        
                        $sql = mysql_query("SELECT * FROM usulan_dudi WHERE id_siswa='$r[id_siswa]'");
                        $hasil = mysql_fetch_array($sql);
                        $id_du_di = $hasil['id_du_di'];

                        $sql1 = mysql_query("SELECT * FROM user WHERE id_user='$id_du_di'");
                        $num = mysql_num_rows($sql1);

                        if ($num==0) {
                          $sql1 = mysql_query("INSERT INTO user VALUES ('$id_du_di', '$id_du_di', 'DUDI')");
                        }
                        
                        echo '<script>window.location="index.php?admin&p=peta"</script>';
                          // echo '<script>window.location="index.php?admin&p=proses_acc&s=$r[id_siswa]&guru_pembimbing=$guru_pembimbing"</script>';
                      }
                      ?>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>

              <div class="modal fade" id="<?php echo 'batalacc'.$r['id_siswa']?>">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">ACC</h4>
                      </div>
                      <div class="modal-body">
                        Apakah anda ingin membatalkan persetujuan <?php echo $r['nama_siswa']?> untuk magang di <?php echo $r['nama_du_di']?>?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                        <a href="?admin&p=proses_batal_acc&s=<?php echo $r['id_siswa']?>" class="btn btn-danger">Batalkan</a>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>

                <div class="modal fade" id="<?php echo 'edit'.$r['id_siswa']?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Pemetaan</h4>
                        </div>
                        <div class="modal-body">
                          <form action="" method="post">
                            <div class="form-group has-feedback">
                              <label>Nama</label>
                              <input type="hidden" name="id_siswa" class="form-control" value='<?php echo $r["id_siswa"]; ?>'>
                              <input type="text" name="passwordlama" class="form-control" disabled value='<?php echo $r["nama_siswa"]; ?>'>
                              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                              <label>Program Keahlian</label>
                              <input type="text" name="passwordbaru" class="form-control" disabled value='<?php echo $r["program_keahlian"]; ?>'>
                              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                              <label>Status Pondok</label>
                              <input type="text" name="passwordbaru2" class="form-control" disabled value='<?php echo $r["status_pondok"]; ?>'>
                              <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                              <label>Nama DUDI</label>
                              <select class="form-control" name="id_du_di">
                                <?php
                                $query = mysql_query("SELECT * FROM du_di");
                                while($hasil = mysql_fetch_array($query)){
                                  if($hasil['id_du_di'] == $r['id_du_di']){
                                    ?>
                                    <option value="<?php echo $hasil['id_du_di']?>" selected><?php echo $hasil['nama_du_di'].' ('.$hasil['alamat'].')'?></option>
                                    <?php      
                                  }else{
                                    ?>
                                    <option value="<?php echo $hasil['id_du_di']?>"><?php echo $hasil['nama_du_di'].' ('.$hasil['alamat'].')'?></option>
                                    <?php
                                  }
                                }
                                ?>
                              </select>
                              <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>

                            <button type="submit" name="simpan" class="btn btn-primary">Simpan Perubahan data</button>
                          </form>
                          <?php
                          if (isset($_POST['simpan'])) {
                            $id_siswa=$_POST['id_siswa'];
                            $id_du_di=$_POST['id_du_di'];

                            mysql_query("UPDATE usulan_dudi SET id_du_di='$id_du_di' WHERE id_siswa='$id_siswa'");
                            echo '<script>window.location="index.php?admin&p=peta"</script>';
                          }
                          ?>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>

                  <?php } ?>
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