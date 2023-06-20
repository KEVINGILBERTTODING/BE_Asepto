<div class="row">
  <div class="col-12 grid-margin">
    <div class="card" style="background: #2c2d30;">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col">
            <h4 class="card-title text-white">Masukan Feedback</h4>
          </div>
          <div class="col text-right">
            <a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-primary">Kembali</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-white" style="background: #2c2d30;">

            <form action="<?php echo base_url(); ?>admin/Feedback/tambah" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label for="exampleInputUsername1">Tipe Perusahaan:</label>
                <select name="tipe_perusahaan" class="form-control">
                  <option value="">
                    <?php if ($tipe['tipe_perusahaan'] == 'Small') {
                      echo "Perusahaan Kecil"
                    ?>
                    <?php } ?>
                    <?php if ($tipe['tipe_perusahaan'] == 'Big') {
                      echo "Perusahaan Besar"
                    ?>
                    <?php } ?>
                  </option>
                  <option value="Small">Perusahaan kecil</option>
                  <option value="Big">Perusahaan Besar</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Nama Project:</label>
                <select name="project_id" class="form-control">
                  <option value="">--Nama Project--</option>
                  <?php foreach ($jenis as $pilihan) : ?>
                    <option value="<?= $pilihan['project_id'] ?>"><?= $pilihan['nama_project'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Nama Karyawan:</label>
                <select name="nama_karyawan" class="form-control">
                  <option value="">--Nama Karyawan--</option>
                  <?php foreach ($namaKaryawan as $pilihan) : ?>
                    <option value="<?= $pilihan['karyawan_id'] ?>"><?= $pilihan['nama'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Tambahkan Feedback untuk Karyawan</label>
                <textarea name="feedback" placeholder="Masukan feedback" class="form-control texteditor"></textarea>
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-success text-right" name="submitData">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- panggil jquery -->
<script type="text/javascript" src="assets/jquery/jquery-3.1.1.min.js"></script>
<!-- panggil ckeditor.js -->
<script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
<!-- panggil adapter jquery ckeditor -->
<script type="text/javascript" src="assets/ckeditor/adapters/jquery.js"></script>
<!-- setup selector -->
<script type="text/javascript">
  $('textarea.texteditor').ckeditor();
</script>