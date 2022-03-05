<?php
if (strtolower($_SESSION['level'])=='admin') {  
  $aksi="admin/data_master/proses_siswa.php";
  $p=isset($_GET['aksi'])?$_GET['aksi']:null;
  switch($p){
    default:
    ?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Siswa</h3>
            <br>
            <br>

            <div class="btn-group" role="group">
              <button id="btnGroupDrop1" type="button" class="btn btn-block" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Tambah Data
              </button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="btn btn-block" href="?admin&p=siswa&aksi=tambah">Tambah Data</a>
                <a class="btn btn-block" href="?admin&p=siswa&aksi=tambaht">Tambah Banyak Data</a>
              </div>
            </div>            
            <!-- <a class="btn btn-success" href="?admin&p=siswa&aksi=tambah"><i class='fa fa-user-plus'></i>Tambah Data
            </a> -->
          </div>
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
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>NAMA</th>
                  <th>Jenis Kelamin</th>
                  <th>Program Studi</th>
                  <th>ACTION</th>
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
                  $tp=mysql_query("SELECT * FROM siswa WHERE tahun_pelajaran='$ss'");
                } else {
                  $tp=mysql_query("SELECT * FROM siswa");
                }
                while($r=mysql_fetch_array($tp)){
                  ?>
                  <tr> 
                    <td><?php echo $i;?></td>
                    <td><?php echo $r['id_siswa'];?></td>
                    <td><?php echo$r['nama_siswa'];?></td>
                    <td><?php echo$r['jk'];?></td>
                    <td><?php echo$r['program_keahlian'];?></td>
                    <td>
                      <a class='btn btn-primary' href='<?php echo "?admin&p=siswa&aksi=edit&id=".$r['id_siswa']; ?>'><i class='icon-edit'></i>Edit</a>
                      <a class='btn btn-danger' href='<?php echo $aksi."?act=hapus&id=".$r['id_siswa'] ?>' onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA INI ... ?')"><i class='icon-trash'></i>Hapus</a></td>
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
        </div>
        <!-- /.row -->
        <?php
        break;

        case "edit":
        $edit = mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");

        $r    = mysql_fetch_array($edit);
        ?>
        <form method='post' action='<?php echo $aksi."?act=update" ?>' enctype='multipart/form-data'>
          <div class='panel panel-border panel-primary'>
            <div class='panel-heading'> 
              <h3 class='panel-title'><i class='fa fa-list'></i> Edit Data Siswa</h3> 
            </div>  
            <div class='panel-body'>
              <!-- <img src="<?php echo substr($r['foto'], 6);?>" width='80px' > -->
              <div class='control-group'>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>NIS</label>
                      <input type="hidden" class="form-control" name="nis" value = '<?php echo $r['id_siswa'];?>'>
                      <input disabled type="text" class="form-control" value = '<?php echo $r['id_siswa'];?>' placeholder="Masukan NIS Siswa" required>
                    </div>
                    <div class="col-md-6">
                      <label>Nama</label>
                      <input type="text" class="form-control" name="nama" value = '<?php echo $r['nama_siswa'];?>' placeholder="Masukan Nama Siswa">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Tempat Lahir</label>
                      <input type="text" class="form-control" name="tempat_lahir" value = '<?php echo $r['tempat_lahir'];?>' placeholder="Masukan Tempat Lahir Siswa">
                    </div>
                    <div class="col-md-6">
                      <label>Tanggal Lahir</label>
                      <input type="date" class="form-control" name="tgl_lahir" value = '<?php echo $r['tanggal_lahir'];?>' placeholder="Masukan Tanggal Siswa">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Jenis Kelamin</label>
                      <select class="form-control" name="jk">
                        <?php
                        if($r['jk']=='Laki-Laki'){
                          echo '
                          <option value="">Masukkan Jenis Kelamin Siswa</option>
                          <option value="laki-laki" selected>Laki-laki</option>
                          <option value="perempuan">Perempuan</option>
                          ';    
                        } else {
                          echo '
                          <option value="">Masukkan Jenis Kelamin Siswa</option>
                          <option value="laki-laki">Laki-laki</option>
                          <option value="perempuan" selected>Perempuan</option>
                          ';
                        }
                        ?>                        
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label>Alamat</label>
                      <input type="text" class="form-control" name="alamat" value = '<?php echo $r['Alamat'];?>' placeholder="Masukan Alamat Siswa">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Program Keahlian</label>
                      <!-- <input type="number" class="form-control" name="jurusan" placeholder="Masukan Program Keahlian Siswa" required> -->
                      <select class="form-control" name="jurusan">
                        <option value="">Masukkan Program Keahlian Siswa</option>
                        <?php
                        $query = mysql_query("SELECT * FROM program_keahlian");
                        while($hasil = mysql_fetch_array($query)){
                          if($hasil['nama'] == $r['program_keahlian']){
                            ?>
                            <option value="<?php echo $hasil['nama']?>" selected><?php echo $hasil['nama']?></option>
                            <?php      
                          }else{
                            ?>
                            <option value="<?php echo $hasil['nama']?>"><?php echo $hasil['nama']?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label>Nama Orang Tua</label>
                      <input type="text" class="form-control" name="nama_ortu" value = '<?php echo $r['nama_ortu'];?>' placeholder="Masukan Orang Tua Siswa">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Status Pondok</label>
                      <!-- <input type="number" class="form-control" name="status_pondok" placeholder="Masukan Status Pondok Siswa" required> -->
                      <select class="form-control" name="status_pondok">
                        <?php
                        if ($r['status_pondok']=='ya') {
                          echo '
                          <option value="">Masukkan Status Pondok Siswa</option>
                          <option value="ya" selected>Ya</option>
                          <option value="tidak">Tidak</option>
                          ';
                        }else{
                          echo '
                          <option value="">Masukkan Status Pondok Siswa</option>
                          <option value="ya">Ya</option>
                          <option value="tidak" selected>Tidak</option>
                          ';
                        }
                        ?>                        
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label>Foto</label>
                      <input type="file" class="form-control" name="foto_siswa" placeholder="Masukan Foto Siswa">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Tahun Pelajaran</label>
                      <input type="text" class="form-control" name="tahun_pelajaran" value = '<?php echo $r['tahun_pelajaran'];?>' placeholder="Masukan Tahun Pelajaran Siswa ex: 2017/2018 (Gelombang 1)">
                    </div>
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
              <a class='btn btn-danger btn-block' href='?admin&p=siswa'>Batal</a>
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
              <h3 class='panel-title'><i class='fa fa-list'></i> Tambah Data Siswa</h3> 
            </div>  
            <div class='panel-body'> 
              <div class='control-group'>

                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>NIS</label>
                      <input type="text" class="form-control" name="nis" placeholder="Masukan NIS Siswa" required>
                    </div>
                    <div class="col-md-6">
                      <label>Nama</label>
                      <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Siswa">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Tempat Lahir</label>
                      <input type="text" class="form-control" name="tempat_lahir" placeholder="Masukan Tempat Lahir Siswa">
                    </div>
                    <div class="col-md-6">
                      <label>Tanggal Lahir</label>
                      <input type="date" class="form-control" name="tgl_lahir" placeholder="Masukan Tanggal Siswa">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Jenis Kelamin</label>
                      <select class="form-control" name="jk">
                        <option value="">Masukkan Jenis Kelamin Siswa</option>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                      </select>
                      <!-- <input type="number" class="form-control" name="jk" placeholder="Masukan Jenis Kelamin Siswa" required> -->
                    </div>
                    <div class="col-md-6">
                      <label>Alamat</label>
                      <input type="text" class="form-control" name="alamat" placeholder="Masukan Alamat Siswa">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Program Keahlian</label>
                      <!-- <input type="number" class="form-control" name="jurusan" placeholder="Masukan Program Keahlian Siswa" required> -->
                      <select class="form-control" name="jurusan">
                        <option value="">Masukkan Program Keahlian Siswa</option>
                        <?php
                        $query = mysql_query("SELECT * FROM program_keahlian");
                        while($hasil = mysql_fetch_array($query)){
                          ?>
                          <option value="<?php echo $hasil['nama']?>"><?php echo $hasil['nama']?></option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label>Nama Orang Tua</label>
                      <input type="text" class="form-control" name="nama_ortu" placeholder="Masukan Orang Tua Siswa">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Status Pondok</label>
                      <select class="form-control" name="status_pondok">
                        <option value="">Masukkan Status Pondok Siswa</option>
                        <option value="ya">Ya</option>
                        <option value="tidak">Tidak</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label>Foto</label>
                      <input type="file" class="form-control" name="foto_siswa" placeholder="Masukan Foto Siswa">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Tahun Pelajaran</label>
                      <input type="text" class="form-control" name="tahun_pelajaran" placeholder="Masukan Tahun Pelajaran Siswa contoh: 2017/2018">
                    </div>
                    <div class="col-md-6">
                    <label>Gelombang Prakerin Siswa</label>
                      <select class="form-control" name="gelombang">
                        <option value="">Masukkan Gelombang Prakerin Siswa</option>
                        <option value="Gelombang 1">Gelombang 1</option>
                        <option value="Gelombang 2">Gelombang 2</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class='panel-footer'>
              <input type='submit' class='btn btn-primary btn-block' value='Tambah Data'> 
              <a class='btn btn-danger btn-block' href='?admin&p=siswa'>Batal</a>
            </div>

          </div>
        </form>

        <?php
        break;
        case "tambaht":
        ?>
        <form method='post' action='?admin&p=siswa_upload' enctype='multipart/form-data'>
          <div class='panel panel-border panel-primary'>
            <div class='panel-heading'> 
              <h3 class='panel-title'><i class='fa fa-list'></i> Tambah Banyak Data</h3> 
            </div>  
            <div class='panel-body'> 
              <div class='control-group'>
                <div class="form-group">
                <label>Upload Excel File (.xls)</label>
                <input type="file" class="form-control" name="fileImport" required>                  
                </div>
              </div>
            </div>
            <div class='panel-footer'>
              <input type='submit' name = "Submit" class='btn btn-primary btn-block' value='Tambah Data'> 
              <a class='btn btn-danger btn-block' href='?admin&p=siswa'>Batal</a>
            </div>

          </div>
        </form>

        <?php
        break;
      }

    } else {
      echo 'akses ditolak';
    }
    ?>