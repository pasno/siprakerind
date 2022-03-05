<?php
if (strtolower($_SESSION['level'])=='admin') {
  ?>
  <div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Nilai Prakerin Siswa</h3>
        </div>
        <!-- /.box-header -->
        <hr>
        <div style="padding-left: 11px; padding-bottom:9px" class="form-inline">
          <form action="" method="post">
            <select style="height:34px; width:204px;" class="custom-select" name="seleksitahun">
              <option value="">Berdasarkan Tahun Pelajaran </option>
              <?php
              $sql1= mysql_query("SELECT * FROM siswa");
              $tp1='';
              while ($hasil1=mysql_fetch_array($sql1)) {
                $tp=$hasil1['tahun_pelajaran'];
                if ($tp!=$tp1) {
                  
                  if (isset($_GET['s'])) {
                    $s = $_GET['s'];
                    if ((substr($s, 0, 9)==substr($tp, 0, 9)) and ((substr($s, 21, 1)==substr($tp, 21, 1)))) {
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
            <select style="height:34px;" class="custom-select" name="program_keahlian">
              <option value="">Berdasarkan Program Keahlian </option>
              <?php
              $sql2= mysql_query("SELECT * FROM program_keahlian");
              while ($hasil2=mysql_fetch_array($sql2)) {
                $tpa=$hasil2['nama'];
                ?>
                <option value="<?php echo $tpa;?>"><?php echo $tpa;?></option>
            <?php
              }
            ?>
            </select>
              <button type="submit" value="cari" name="cari" class="btn btn-primary">Tampilkan</button>
              <button type="submit" value="cetak" name="cari" class="btn btn-success"><i class='fa fa-print'></i>
               Cetak
              </button>
          </form>
          <?php
            if (isset($_POST['cari'])) {
              $seleksitahun = strtolower(preg_replace('/\s/', '_', $_POST['seleksitahun']));
              $programk = preg_replace('/\s/', '_', $_POST['program_keahlian']);
              if ($_POST['cari']=='cari') {
              echo '<script>window.location="index.php?admin&p=nilai&s='.$seleksitahun.'&j='.$programk.'"</script>';
             }
              else if ($_POST['cari']=='cetak') {
              echo '<script>window.location="file/report_nilai.php?s='.$seleksitahun.'&j='.$programk.'"</script>';
            }
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
                <th>Tempat Prakerin</th>
                <th>Nilai Sikap</th>
                <th>Nilai Kinerja</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i=1;
              if ((isset($_GET['s'])) and ($_GET['s']!='') and ($_GET['j']) and ($_GET['j']!=''))  {
                  $s = $_GET['s'];
                  $ss = str_replace('_', ' ', $s); // (0= karakter ke-, 9 = jumlah karakter yg diambil)
                  $j = $_GET['j'];
                  $jj = str_replace('_', ' ', $j); //replace underscore
                  $tp=mysql_query("SELECT * FROM siswa, du_di, nilai 
                                            WHERE siswa.id_siswa = nilai.id_siswa
                                            AND du_di.id_du_di = nilai.id_du_di 
                                            AND siswa.tahun_pelajaran='$ss' 
                                            AND siswa.program_keahlian = '$jj'");
                }
                else {                  
                  $tp=mysql_query("SELECT siswa.nama_siswa,du_di.nama_du_di,
                                          nilai.nilai_sikap,
                                          nilai.nilai_kinerja FROM du_di, nilai, siswa 
                                          WHERE siswa.id_siswa = nilai.id_siswa 
                                          AND du_di.id_du_di = nilai.id_du_di");
                }     

              while($r=mysql_fetch_array($tp)){
                ?>
                <tr> 
                  <td><?php echo $i;?></td>
                  <td><?php echo $r['nama_siswa'];?></td>
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
  }else{
    echo "Akses Ditolak";
  }
  ?>