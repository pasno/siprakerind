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
          <h3 class="box-title">Nilai Prakerin Siswa</h3>
          <hr>
          Nama : <?php echo $data['nama_siswa']?><br>
          Nama : <?php echo $data['program_keahlian']?>
          
          <hr>
          <?php
          $sql = mysql_query("SELECT * FROM nilai WHERE id_siswa='$id_siswa' AND id_du_di='$_SESSION[username]'");
          $hasil = mysql_num_rows($sql);
          if ($hasil==0) {
            ?>
            <button type='button' class='btn btn-primary' data-toggle="modal" data-target="#modal-default"> <i class='fa fa-user-plus'></i>Klik untuk Memasukkan Nilai
            </button>
            <?php
          } else {
            ?>
            <button type='button' class='btn btn-primary' disabled="" data-toggle="modal" data-target="#modal-default"> <i class='fa fa-user-plus'></i>Nilai Sudah Terinput
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
                <th>Nama Siswa</th>
                <th>Program Keahlian</th>
                <th>Nilai Sikap</th>
                <th>Nilai Kinerja</th>
                <th>Tools</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i=1;
              $tp=mysql_query("SELECT * FROM siswa, nilai WHERE siswa.id_siswa=nilai.id_siswa AND nilai.id_siswa='$id_siswa'");

              while($r=mysql_fetch_array($tp)){
                $id_nilai = $r['id_nilai'];
                ?>
                <tr> 
                  <td><?php echo $i;?></td>
                  <td><?php echo $r['nama_siswa'];?></td>
                  <td><?php echo$r['program_keahlian'];?></td>
                  <td><?php echo$r['nilai_sikap'];?></td>
                  <td><?php echo$r['nilai_kinerja'];?></td>
                  <td>
                    <a href="?p=hapus_nilai&id_nilai=<?php echo $r['id_nilai']?>&siswa=<?php echo $id_siswa?>" name ='hapus' class="btn btn-danger"><i class='fa fa-trash-o '></i> Hapus</a>
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
            <h4 class="modal-title">Masukkan Nilai Siswa</h4>
          </div>
          <div class="modal-body">
            <form action="" method="post">  
              <div class="form-group has-feedback">          
                <select class="form-control" name="nilai_sikap">
                <option value="">Masukkan Nilai Sikap Siswa</option>
                  <option value="Amat Baik (AB)">Amat Baik (AB)</option>
                  <option value="Baik (B)">Baik (B)</option>
                  <option value="Kurang (K)">Kurang (K)</option>                
                </select>
              </div>
              <div class="form-group has-feedback">
                <select class="form-control" name="nilai_kinerja">
                  <option value="">Masukkan Nilai Kinerja Siswa</option>
                  <option value="Amat Baik (AB)">Amat Baik (AB)</option>
                  <option value="Baik (B)">Baik (B)</option>
                  <option value="Kurang (K)">Kurang (K)</option>                
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
              <button name = 'simpan' type="submit" class="btn btn-primary">Simpan</button>
            </form>
            <?php
            if (isset($_POST['simpan'])) {
              mysql_query("INSERT INTO nilai VAlUES ('','$_SESSION[username]','$id_siswa','$_POST[nilai_sikap]','$_POST[nilai_kinerja]')");
              echo '<script>window.location="index.php?dudi&p=proses_nilai&siswa='.$id_siswa.'"</script>';
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