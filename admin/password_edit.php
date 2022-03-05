<?php
if (strtolower($_SESSION['level'])=='admin') {
  ?>
  <div class="modal-content">
    <div class="modal-header">
      <span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Edit Password</h4>
    </div>
    <div class="modal-body">
      <form action="?admin&p=proses_edit_password" method="post">
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
        <button type="submit" class="btn btn-primary">Save changes</button>
      </form>
    </div>
  </div>
  <?php
}else {
  echo 'Akses ditolak';
}
?>

