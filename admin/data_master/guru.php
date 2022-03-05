<?php
if (strtolower($_SESSION['level'])=='admin') {
  $aksi="admin/data_master/proses_guru.php";
  $p=isset($_GET['aksi'])?$_GET['aksi']:null;
  switch($p){
    default:
    ?>
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box-header">
            <h4 class="box-title">Data Guru</h4>
            <br>
            <br>
            <a class = "btn btn-success"  href="?admin&p=guru&aksi=tambah"><i class='fa fa-user-plus'></i>Tambah Data</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIP</th>
                  <th>NAMA</th>
                  <th>TEMPAT LAHIR</th>
                  <th>ACTION</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i=1;
                $tp=mysql_query("SELECT * FROM guru");
                while($r=mysql_fetch_array($tp)){
                  ?>
                  <tr> 
                    <td><?php echo $i;?></td>
                    <td><?php echo $r['id_guru'];?></td>
                    <td><?php echo$r['nama_guru'];?></td>
                    <td><?php echo$r['tempat_lahir'];?></td>
                    <td>
                      <a class='btn btn-primary' href='<?php echo "?admin&p=guru&aksi=edit&id=".$r['id_guru']; ?>'><i class='icon-edit'></i>Edit</a>
                      <a class='btn btn-danger' href='<?php echo $aksi."?act=hapus&id=".$r['id_guru'] ?>' onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA INI ... ?')"><i class='icon-trash'></i>Hapus</a></td>
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
        $edit = mysql_query("SELECT * FROM guru WHERE id_guru='$_GET[id]'");

        $r    = mysql_fetch_array($edit);
        ?>
        <form method='post' action='<?php echo $aksi."?act=update" ?>' enctype='multipart/form-data'>
          <div class='panel panel-border panel-primary'>
            <div class='panel-heading'> 
              <h3 class='panel-title'><i class='fa fa-list'></i> Edit Data Guru</h3> 
            </div>  
            <div class='panel-body'> 
              <!-- <img src="<?php echo substr($r['foto'], 6); ?>" width='80px'> -->
              <div class='control-group'>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>NIP</label>
                      <input type='hidden' name = "id_guru" value='<?php echo $r["id_guru"]; ?>'>
                      <input disabled type="text" class="form-control" value='<?php echo $r["id_guru"]; ?>' placeholder="Masukan NIP Guru" required>
                    </div>
                    <div class="col-md-6">
                      <label>Nama Guru</label>
                      <input type="text" class="form-control" name="nama_guru" value='<?php echo $r["nama_guru"]; ?>' placeholder="Masukan Nama Guru">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Tempat Lahir</label>
                      <input type="text" class="form-control" name="tempat_lahir" value='<?php echo $r["tempat_lahir"]; ?>'placeholder="Masukan Tempat Lahir Guru">
                    </div>
                    <div class="col-md-6">
                      <label>Tanggal Lahir</label>
                      <input type="date" class="form-control" name="tgl_lahir" value='<?php echo $r["tanggal_lahir"];?>'placeholder="Masukan Tanggal Guru">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Jenis Kelamin</label>
                      <select class="form-control" name="jk_guru">
                        <?php
                        if ($r['jk_guru']=='Laki-Laki') {
                          echo '
                          <option value="">Masukkan Jenis Kelamin Guru</option>
                          <option value="laki-laki" selected>Laki-laki</option>
                          <option value="perempuan">Perempuan</option>
                          ';
                        }else{
                          echo '
                          <option value="">Masukkan Jenis Kelamin Guru</option>
                          <option value="laki-laki">Laki-laki</option>
                          <option value="perempuan"selected>Perempuan</option>
                          ';
                        }
                        ?>                        
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label>Alamat</label>
                      <input type="text" class="form-control" name="alamat_guru" value="<?php echo $r['alamat_guru']; ?>" placeholder="Masukan Alamat Guru">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Status Jabatan</label>
                      <select class="form-control" name="status_jabatan">
                        <option value="">Masukkan Bidang Ajar Guru</option>
                        <?php
                        $query = mysql_query("SELECT * FROM program_keahlian");
                        while($hasil = mysql_fetch_array($query)){
                          if($hasil['nama'] == $r['status_jabatan']){
                            ?>
                            <option value="<?php echo $hasil['nama']?>" selected>Guru <?php echo $hasil['nama']?></option>
                            <?php      
                          }else{
                            ?>
                            <option value="<?php echo $hasil['nama']?>">Guru <?php echo $hasil['nama']?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label>Foto</label>
                      <input type="file" class="form-control" name="foto_guru" placeholder="Masukan Foto Siswa">
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
              <a class='btn btn-danger btn-block' href='?admin&p=guru'>Batal</a>
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
              <h3 class='panel-title'><i class='fa fa-list'></i> Tambah Data Guru</h3> 
            </div>  
            <div class='panel-body'> 
              <div class='control-group'>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>NIP</label>
                      <input type="text" class="form-control" name="id_guru" placeholder="Masukan NIP Guru" required>
                    </div>
                    <div class="col-md-6">
                      <label>Nama Guru</label>
                      <input type="text" class="form-control" name="nama_guru" placeholder="Masukan Nama Guru">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Tempat Lahir</label>
                      <input type="text" class="form-control" name="tempat_lahir" placeholder="Masukan Tempat Lahir Guru">
                    </div>
                    <div class="col-md-6">
                      <label>Tanggal Lahir</label>
                      <input type="date" class="form-control" name="tanggal_lahir" placeholder="Masukan Tanggal Guru">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Jenis Kelamin</label>
                      <select class="form-control" name="jk_guru">
                        <option value="">Masukkan Jenis Kelamin Guru</option>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                      </select>
                      <!-- <input type="number" class="form-control" name="jk" placeholder="Masukan Jenis Kelamin Siswa" required> -->
                    </div>
                    <div class="col-md-6">
                      <label>Alamat</label>
                      <input type="text" class="form-control" name="alamat_guru" placeholder="Masukan Alamat Guru">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Bidang Ajar</label>
                      <select class="form-control" name="status_jabatan">
                        <option value="">Masukkan Bidang Ajar Guru</option>
                        <?php
                        $query = mysql_query("SELECT * FROM program_keahlian");
                        while($hasil = mysql_fetch_array($query)){
                          if($hasil['nama'] == $r['program_keahlian']){
                            ?>
                            <option value="<?php echo $hasil['nama']?>" selected>Guru <?php echo $hasil['nama']?></option>
                            <?php      
                          }else{
                            ?>
                            <option value="<?php echo $hasil['nama']?>">Guru <?php echo $hasil['nama']?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label>Foto</label>
                      <input type="file" class="form-control" name="foto_guru" placeholder="Masukan Foto Siswa">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class='panel-footer'>
              <input type='submit' class='btn btn-primary btn-block' value='Tambah Data'> 
              <a class='btn btn-danger btn-block' href='?admin&p=guru'>Batal</a>
            </div>     
          </div>
        </form>
        <?php
        break;
      }}else {
        echo 'Akses ditolak';
      }      
      ?>