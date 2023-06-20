<div class="row">
  <div class="col-12 grid-margin">
    <div class="card" style="background: #2c2d30;">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col">
            <h4 class="card-title text-white">Tambah Karyawan</h4>
          </div>
          <div class="col text-right">
            <a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-primary">Kembali</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-white" style="background: #2c2d30;">

            <form action="<?php echo base_url(); ?>admin/karyawan/tambah" method="POST" enctype="multipart/form-data">

              <div class="form-group">
                <label for="exampleInputUsername1">Nama Karyawan</label>
                <input type="text" class="form-control" name="karyawan" placeholder="name" value="" required>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Email</label>
                <input type="text" class="form-control" name="email" placeholder="masukan alamat email" value="" required>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Nomer HP</label>
                <input type="text" class="form-control" name="telp" placeholder="masukan Nomer HP" value="" required>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Nomer Rekening</label>
                <input type="text" class="form-control" name="norek" placeholder="masukan Nomer Rekening" value="" required>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Nama Bank</label>
                <input type="text" class="form-control" name="bank" placeholder="masukan nama Bank" value="" required>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Jenis Kelamin:</label>
                <select name="jeniskel" class="form-control">
                  <option value="">
                    <?php if ($jenis['jeniskel'] == 'Laki-Laki') {
                      echo "Laki-Laki"
                    ?>
                    <?php } ?>
                    <?php if ($jenis['jeniskel'] == 'Perempuan') {
                      echo "Perempuan"
                    ?>
                    <?php } ?>
                  </option>
                  <option value="L">Laki-Laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Posisi Jabatan:</label>
                <select name="jabatan" class="form-control">
                  <option value="UI/UX Designer">UI/UX Designer</option>
                  <option value="Branding Designer">Branding Designer</option>
                  <option value="3D Ilustrator">3D Ilustrator</option>
                </select>
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