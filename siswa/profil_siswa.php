<?php
if (strtolower($_SESSION['level'])=='siswa') {
  $edit = mysql_query("SELECT * FROM siswa WHERE id_siswa='$_SESSION[username]'");
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
              <label>NIS</label>
              <input type="hidden" class="form-control" name="nis" value = '<?php echo $r['id_siswa'];?>'>
              <input disabled type="text" style="border:none" class="form-control" value = '<?php echo $r['id_siswa'];?>'>
            </div>
            <div class="col-md-6">
              <label>Nama</label>
              <input disabled type="text" style="border:none" class="form-control" name="nama" value = '<?php echo $r['nama_siswa'];?>'>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <label>Tempat Lahir</label>
              <input disabled type="text" style="border:none" class="form-control" name="tempat_lahir" value = '<?php echo $r['tempat_lahir'];?>' placeholder="Masukan Tempat Lahir Siswa">
            </div>
            <div class="col-md-6">
              <label>Tanggal Lahir</label>
              <input disabled type="date" style="border:none" class="form-control" name="tgl_lahir" value = '<?php echo $r['tanggal_lahir'];?>'>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <label>Jenis Kelamin</label>
              <input disabled type="text" style="border:none" class="form-control" name="jk" value = '<?php echo $r['jk'];?>'>
            </div>
            <div class="col-md-6">
              <label>Alamat</label>
              <input disabled type="text" style="border:none" class="form-control" name="alamat" value = '<?php echo $r['Alamat'];?>'>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <label>Program Keahlian</label>
              <input disabled type="text" style="border:none" class="form-control" name="jurusan" value = '<?php echo $r['program_keahlian'];?>'>
            </div>
            <div class="col-md-6">
              <label>Nama Orang Tua</label>
              <input disabled type="text" style="border:none" class="form-control" name="nama_ortu" value = '<?php echo $r['nama_ortu'];?>'>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <label>Status Pondok</label>
              <input disabled type="text" style="border:none" class="form-control" name="status_pondok" value = '<?php echo $r['status_pondok'];?>'>
            </div>
            <div class="col-md-6">
              <label>Tahun Pelajaran</label>
              <input disabled type="text" style="border:none" class="form-control" name="tahun_pelajaran" value = '<?php echo $r['tahun_pelajaran'];?>'>
            </div>
          </div>
          
        </div>
      </div>

    </div>
    <div class='panel-footer'>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
        Edit Password
      </button>

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
              <form action="?siswa&p=proses_edit_siswa" method="post">
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
      <?php }else{
        echo "Akses Ditolak";
      } ?>