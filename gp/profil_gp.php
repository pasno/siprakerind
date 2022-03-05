<?php
if (strtolower($_SESSION['level'])=='guru') {
  $edit = mysql_query("SELECT * FROM guru WHERE id_guru='$_SESSION[username]'");
  $r    = mysql_fetch_array($edit);
  ?>
  <div class='panel panel-border panel-primary'>
    <div class='panel-heading'> 
      <h3 class='panel-title'><i class='fa fa-list'></i> Data Pribadi</h3> 
    </div>  
    <div class='panel-body'>
      <div class='control-group'>
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <label>NIP</label>
              <input type='hidden' name='id' name = "id_guru" value='<?php echo $r["id_guru"]; ?>'>
              <input disabled type="text" class="form-control" value='<?php echo $r["id_guru"]; ?>'>
            </div>
            <div class="col-md-6">
              <label>Nama Guru</label>
              <input disabled type="text" class="form-control" name="nama_guru" value='<?php echo $r["nama_guru"]; ?>'>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <label>Tempat Lahir</label>
              <input disabled type="text" class="form-control" name="tempat_lahir" value='<?php echo $r["tempat_lahir"]; ?>'>
            </div>
            <div class="col-md-6">
              <label>Tanggal Lahir</label>
              <input disabled type="date" class="form-control" name="tgl_lahir" value='<?php echo $r["tanggal_lahir"];?>'>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <label>Jenis Kelamin</label>
              <input disabled type="text" class="form-control" name="jk_guru" value="<?php echo $r['jk_guru']; ?>">
            </div>
            <div class="col-md-6">
              <label>Alamat</label>
              <input disabled type="text" class="form-control" name="alamat_guru" value="<?php echo $r['alamat_guru']; ?>">
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <label>Status Jabatan</label>
              <input disabled type="text" class="form-control" name="status_jabatan" value="<?php echo $r['status_jabatan']; ?>">
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <?php 
                  $untukpassword = mysql_query("SELECT * FROM user WHERE id_user = '$_SESSION[username]' ");
                  $u = mysql_fetch_array($untukpassword);
                  ?>
                  <label>Password</label>
                  <input disabled type="text" class="form-control" name="password" value = '<?php echo $u['password'];?>'>
                </div>
              </div>
            </div>
          </div>
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
            <form action="?guru&p=proses_edit_guru" method="post">
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
    <?php 
  }else{
    echo "Akses Ditolak";
  } ?>