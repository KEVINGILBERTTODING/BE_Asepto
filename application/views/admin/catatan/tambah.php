<div class="row">
  <div class="col-12 grid-margin">
    <div class="card" style="background: #2c2d30;">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col">
            <h4 class="card-title text-white">Tambah Catatan</h4>
          </div>
          <div class="col text-right">
            <a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-primary">Kembali</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-white" style="background: #2c2d30;">

            <form action="<?php echo base_url(); ?>admin/Catatan/tambah" method="POST" enctype="multipart/form-data">

              <div class="form-group">
                <label for="exampleInputUsername1">Catatan Tambahan</label>
                <textarea name="catatan" placeholder="Masukan Catatan Tambahan" class="form-control texteditor"></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Tanggal Event</label>
                <input required type="datetime-local" class="form-control" name="tanggal_event" value="">
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