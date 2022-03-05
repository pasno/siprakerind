<?php
if (strtolower($_SESSION['level'])=='admin') {
  $aksi="admin/data_master/proses_dudi.php";
  $p=isset($_GET['aksi'])?$_GET['aksi']:null;
  switch($p){
  default:
?>
     <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data DUDI</h3>
              <br>
              <br>
              <a class = "btn btn-success"  href="?admin&p=dudi&aksi=tambah"><i class='fa fa-user-plus'></i>Tambah Data</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama DUDI</th>
                  <th>Bidang Usaha</th>
                  <th>Nama Pimpinan</th>
                  <th>Alamat</th>
                  <th>ACTION</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $i=1;
                  $tp=mysql_query("SELECT * FROM du_di ORDER BY nama_du_di");
                  while($r=mysql_fetch_array($tp)){
                ?>
                  <tr> 
                    <td><?php echo $i;?></td>
                    <td><?php echo $r['nama_du_di'];?></td>
                    <td><?php echo$r['bidang_usaha'];?></td>
                    <td><?php echo$r['nama_pimpinan'];?></td>
                    <td><?php echo$r['alamat'];?></td>
                    <td>
                      <a class='btn btn-primary' href='<?php echo "?admin&p=dudi&aksi=edit&id=".$r['id_du_di']; ?>'><i class='icon-edit'></i>Edit</a>
                      <a class='btn btn-danger' href='<?php echo $aksi."?act=hapus&id=".$r['id_du_di'] ?>' onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA INI ... ?')"><i class='icon-trash'></i>Hapus</a></td>
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
      <!-- /.row -->
<?php
  break;

case "edit":
  $edit = mysql_query("SELECT * FROM du_di WHERE id_du_di='$_GET[id]'");
  $r    = mysql_fetch_array($edit);
?>
      <form method='post' action='<?php echo $aksi."?act=update" ?>' enctype='multipart/form-data'>
        <div class='panel panel-border panel-primary'>
              <div class='panel-heading'> 
                  <h3 class='panel-title'><i class='fa fa-list'></i> Edit Data DUDI</h3> 
              </div>  
              <div class='panel-body'>
              <!-- <img src="<?php echo substr($r['foto'], 6); ?>" width='80px'>  -->
                <div class='control-group'>
                  <div class="form-group">
                    <div class="col-md-6">
                      <label>ID DUDI</label>
                      <input type='hidden' name='id_du_di' name = "id_du_di" value='<?php echo $r["id_du_di"]; ?>'>
                      <input disabled type="text" class="form-control" name="id_du_di" value = '<?php echo $r['id_du_di'];?>' placeholder="Masukan ID DUDI" required>
                    </div>
                    <div class="col-md-6">
                      <label>Nama DUDI</label>
                      <input type="text" class="form-control" name="nama_du_di" value = '<?php echo $r['nama_du_di']; ?>' placeholder="Masukan Nama DUDI">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label>Bidang Usaha</label>
                        <input type="text" class="form-control" name="bidang_usaha" value = '<?php echo $r['bidang_usaha']; ?>' placeholder="Masukan Bidang Usaha DUDI">
                      </div>
                      <div class="col-md-6">
                        <label>Nama Pimpinan</label>
                        <input type="text" class="form-control" name="nama_pimpinan" value = '<?php echo $r['nama_pimpinan']; ?>' placeholder="Masukan Nama Pimpinan">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                      <label>Nama Pembimbing</label>
                      <input type="text" class="form-control" name="nama_pembimbing" value = '<?php echo $r['nama_pembimbing']; ?>' placeholder="Masukan Nama Pimpinan">  
                      </div>
                      <div class="col-md-6">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" value = '<?php echo $r['alamat']; ?>' placeholder="Masukan Alamat DUDI">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label>Foto</label>
                        <input type="file" class="form-control" name="foto_dudi" placeholder="Masukan Foto DUDI">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                    <?php 
                    $untukpassword = mysql_query("SELECT * FROM user WHERE id_user = '$_GET[id]' ");
                    $u = mysql_fetch_array($untukpassword);
                    ?>
                      <label>Password</label>
                      <input type="text" class="form-control" name="password" value = '<?php echo $u['password'];?>' placeholder="Masukan Tempat Lahir Siswa">
                    </div>
                  </div>
                </div>
                
                </div>
              </div>
          <div class='panel-footer'>
            <input type='submit' class='btn btn-primary btn-block' value='Edit Data'> 
            <a class='btn btn-danger btn-block' href='?admin&p=dudi'>Batal</a>
          </div>

        </div>
      </form>

<?php
break;
case "tambah":
?>
      <form method='post' action='<?php echo $aksi."?act=input" ?>' enctype='multipart/form-data'>
        <div class='panel panel-border panel-primary'>
          <div class='panel-heading'> 
              <h3 class='panel-title'><i class='fa fa-list'></i> Tambah Data DUDI</h3> 
          </div>  
          <div class='panel-body'> 
            <div class='control-group'>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>ID DUDI</label>
                      <input type="text" class="form-control" name="id_du_di" placeholder="Masukan ID DUDI" required>
                    </div>
                    <div class="col-md-6">
                      <label>Nama DUDI</label>
                      <input type="text" class="form-control" name="nama_du_di" placeholder="Masukan Nama DUDI">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Bidang Usaha</label>
                      <input type="text" class="form-control" name="bidang_usaha" placeholder="Masukan Bidang Usaha DUDI">
                    </div>
                    <div class="col-md-6">
                      <label>Nama Pimpinan</label>
                      <input type="text" class="form-control" name="nama_pimpinan" placeholder="Masukan Nama Pimpinan">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                    <label>Nama Pembimbing</label>
                    <input type="text" class="form-control" name="nama_pembimbing" placeholder="Masukan Nama Pimpinan">  
                    </div>
                    <div class="col-md-6">
                      <label>Alamat</label>
                      <input type="text" class="form-control" name="alamat" placeholder="Masukan Alamat DUDI">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Foto</label>
                      <input type="file" class="form-control" name="foto_dudi" placeholder="Masukan Foto DUDI">
                    </div>
                  </div>
                </div>

            </div>
          </div>

          <div class='panel-footer'>
            <input type='submit' class='btn btn-primary btn-block' value='Tambah Data'> 
            <a class='btn btn-danger btn-block' href='?admin&p=dudi'>Batal</a>
          </div>

        </div>
      </form>

<?php
break;
}
} else {
  echo 'Akses ditolak';
}
?>