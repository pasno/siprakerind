<?php
if (strtolower($_SESSION['level'])=='dudi') {
  $edit = mysql_query("SELECT * FROM du_di WHERE id_du_di='$_SESSION[username]'");
  $r    = mysql_fetch_array($edit);
  ?>
  <div class='panel panel-border panel-primary'>
    <div class='panel-heading'> 
      <h3 class='panel-title'><i class='fa fa-list'></i> Data Pribadi</h3> 
    </div>  
    <div class='panel-body'>
      <div class='control-group'>
        <div class="form-group">
          <div class="col-md-6">
            <label>ID DUDI</label>
            <input type='hidden' name='id_du_di' name = "id_du_di" value='<?php echo $r["id_du_di"]; ?>'>
            <input disabled type="text" class="form-control" name="id_du_di" value = '<?php echo $r['id_du_di'];?>'>
          </div>
          <div class="col-md-6">
            <label>Nama DUDI</label>
            <input disabled type="text" class="form-control" name="nama_du_di" value = '<?php echo $r['nama_du_di']; ?>'>
          </div>
        </div>
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <label>Bidang Usaha</label>
              <input disabled type="text" class="form-control" name="bidang_usaha" value = '<?php echo $r['bidang_usaha']; ?>'>
            </div>
            <div class="col-md-6">
              <label>Nama Pimpinan</label>
              <input disabled type="text" class="form-control" name="nama_pimpinan" value = '<?php echo $r['nama_pimpinan']; ?>'>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <label>Nama Pembimbing</label>
              <input disabled type="text" class="form-control" name="nama_pembimbing" value = '<?php echo $r['nama_pembimbing']; ?>'>  
            </div>
            <div class="col-md-6">
              <label>Alamat</label>
              <input disabled type="text" class="form-control" name="alamat" value = '<?php echo $r['alamat']; ?>'>
            </div>
          </div>
        </div>
        <div class="form-group">
         
        </div>
        
      </div>
    </div>
    <div class='panel-footer'>
      <button type='button' class='btn btn-primary' data-toggle="modal" data-target="#modal-default">
        Edit Password
      </button>
    </div>
  </div>
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Password</h4>
          </div>
          <div class="modal-body">
            <form action="?dudi&p=proses_edit_dudi" method="post">
              <div class="form-group has-feedback">
                <input type="password" name="passwordlama" class="form-control" placeholder="Masukkan Password Lama" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input type="password" name="passwordbaru" class="form-control" placeholder="Masukkan Password Baru" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input type="password" name="passwordbaru2" class="form-control" placeholder="Masukkan Lagi Password Baru" required>
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
              </div>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              
              <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
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