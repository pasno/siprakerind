<?php 
if (strtolower($_SESSION['level'])=='siswa') {

  $sql = mysql_query("SELECT * FROM usulan_dudi WHERE id_siswa = '$_SESSION[username]'");
  $num = mysql_num_rows($sql);
  if ($num == 0) {
   ?>
   <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data DUDI</h3>
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
                </tr>
                <?php $i++;
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

    <form method='post' action='?siswa&p=proses_usul' enctype='multipart/form-data'>
      <div class='panel panel-border panel-primary'>
        <div class='panel-heading'> 
          <h3 class='panel-title'><i class='fa fa-list'></i> Mengusulkan DUDI</h3> 
        </div>  
        <div class='panel-body'>
          <!-- <h4 style="text-align: justify;">
            Isilah form berikut dengan data dudi pilihan anda sesuai dengan data dudi yang tersedia di data dudi. Klik <a href="?siswa&p=data_dudi">disini</a> untuk membuka data dudi. Jika dudi pilihan anda belum tersedia di data dudi, isilah form berikut dengan data yang valid.
          </h4>  -->
          <div class='control-group'>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <label>Nama DUDI</label>
                  <input type="text" class="form-control" name="nama_du_di" placeholder="Masukan Nama DUDI">
                </div>
                <div class="col-md-6">
                  <label>Bidang Usaha</label>
                  <input type="text" class="form-control" name="bidang_usaha" placeholder="Masukan Bidang Usaha DUDI">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <label>Nama Pimpinan</label>
                  <input type="text" class="form-control" name="nama_pimpinan" placeholder="Masukan Nama Pimpinan">
                </div>
                <div class="col-md-6">
                  <label>Alamat</label>
                  <input type="text" class="form-control" name="alamat" placeholder="Masukan Alamat DUDI">
                </div>
              </div>
            </div>       

          </div>
        </div>

        <div class='panel-footer'>
          <input type='submit' class='btn btn-primary btn-block' value='Usulkan Data DUDI'> 
        </div>

      </div>
    </form>
    <?php 
  } else {
    ?>
     <div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Usulan DUDI Anda</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nama DUDI</th>
              <th>Bidang Usaha</th>
              <th>Nama Pimpinan</th>
              <th>Alamat</th>
              <th>Status</th>
              <th>Tools</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $tp=mysql_query("select * from du_di, usulan_dudi WHERE du_di.id_du_di=usulan_dudi.id_du_di AND usulan_dudi.id_siswa='$_SESSION[username]'");
            while($r=mysql_fetch_array($tp)){
              ?>
              <tr> 
                <td><?php echo $r['nama_du_di'];?></td>
                <td><?php echo $r['bidang_usaha'];?></td>
                <td><?php echo $r['nama_pimpinan'];?></td>
                <td><?php echo $r['alamat'];?></td>
                <td><?php echo $r['status'];?></td>
                <td>
<!--                   <a class='btn btn-primary' href='file/pdf.php' 
                  <?php if($r['status']=='belum acc'){ echo 'disabled';}?> >
                  <i class='icon-edit'></i>Cetak</a> -->
                  <div class="btn-group">
                    <button <?php if($r['status']=='belum acc'){ echo 'disabled';}?> id="btnGroupDrop1" type="button" class="btn btn-primary" data-toggle="dropdown">
                      Cetak<span class="caret"></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                      <a class="btn" href='file/surat_permohonan.php?siswa=<?php echo $r['id_siswa'];?>' target="_blank">Surat Permohonan</a>
                    </div>
                  </div>
                </td>
              </tr>
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
  }
}else{
  echo "Akses Ditolak";
} ?>