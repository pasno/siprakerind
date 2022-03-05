<?php 
if (strtolower($_SESSION['level'])=='siswa') {
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