<?php
if (strtolower($_SESSION['level'])=='siswa') {
  $siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa='$_SESSION[username]'");
  $data = mysql_fetch_array($siswa);
  ?>
  <div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Nilai Prakerin Siswa</h3>
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
                <th>Nama Siswa</th>
                <th>Tempat Prakerin</th>
                <th>Nilai Sikap</th>
                <th>Nilai Kinerja</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i=1;
              $tp=mysql_query("SELECT du_di.nama_du_di,
                                      nilai.nilai_sikap,
                                      nilai.nilai_kinerja FROM du_di, nilai 
                                      WHERE du_di.id_du_di=nilai.id_du_di 
                                      AND nilai.id_siswa='$_SESSION[username]'");

              while($r=mysql_fetch_array($tp)){
                ?>
                <tr> 
                  <td><?php echo $i;?></td>
                  <td><?php echo $data['nama_siswa'];?></td>
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