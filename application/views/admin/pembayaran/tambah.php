<div class="row">
  <div class="col-12 grid-margin">
    <div class="card" style="background: #2c2d30;">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col">
            <h4 class="card-title" style="color: #fff;">Masukan Pembayaran Karyawan</h4>
          </div>
          <div class="col text-right">
            <a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-primary">Kembali</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-white" style="background: #2c2d30;">

            <form class="user" action="<?php echo base_url(); ?>/admin/Pembayaran/tambah" method="POST" enctype="multipart/form-data">

              <div class="form-group">
                <input type="hidden" class="form-control" name="admin_id" value="">
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Nama Karyawan:</label>
                <select name="id_karyawan" class="form-control">
                  <option value="">--Nama Karyawan--</option>
                  <?php foreach ($namaKaryawan as $pilihan) : ?>
                    <option value="<?= $pilihan['karyawan_id'] ?>"><?= $pilihan['nama'] ?></option>
                  <?php endforeach; ?>
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
                <label for="exampleInputUsername1">Tanggal Bayar</label>
                <input type="datetime-local" class="form-control form-control-user" id="exampleInputEmail" placeholder="Masukan Tanggal Bayar" name="tanggal_bayar" value="" required>
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="exampleInputUsername1">Nominal Bonus</label>
                  <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Masukan Nominal Bonus" name="nominal_bonus" value="">
                </div>
                <div class="col-sm-6">
                  <label for="exampleInputUsername1">Nominal Dibayarkan</label>
                  <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Masukan Nominal Pembayaran" name="nominal_dibayarkan" value="" required>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Bukti Bayar</label>
                <input type="file" class="form-control form-control-user" id="exampleFirstName" placeholder="Lampiran Buktibayar" name="bukti_bayar" required>
              </div>
              <hr>
              <button type="submit" class="btn btn-success btn-block">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>