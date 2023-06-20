<div class="row">
  <div class="col-12 grid-margin">
    <div class="card" style="background: #2c2d30;">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col">
            <h4 class="card-title text-white">Tambah Project</h4>
          </div>
          <div class="col text-right">
            <a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-primary">Kembali</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-white" style="background: #2c2d30;">

            <form action="<?php echo base_url(); ?>admin/project/tambah" method="POST" enctype="multipart/form-data">

              <div class="form-group">
                <label for="exampleInputUsername1">Nama Project</label>
                <input type="text" class="form-control" name="nama_project" placeholder="Nama Project" value="" required>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Deskripsi Project</label>
                <input type="text" class="form-control" name="deskripsi" placeholder="deskripsi" value="" required>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Tanggal Dimulai</label>
                <input required type="datetime-local" class="form-control" name="tgl_mulai" value="">
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Tanggal Berakhir</label>
                <input required type="datetime-local" class="form-control" id="datapicker" name="tgl_selesai" value="" onchange="return CheckD();">
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Nama Perusahaan</label>
                <input type="text" class="form-control" name="nama_perusahaan" placeholder="Nama Perusahaan" value="" required>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Email Perusahaan</label>
                <input type="text" class="form-control" name="email_perusahaan" placeholder="Email Perusahaan" value="" required>
              </div>
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
                <label for="exampleInputUsername1">Nominal Budget</label>
                <input type="text" class="form-control" name="budget" placeholder="Masukan Budget Project" value="" required>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Kategori Project:</label>
                <select name="kategori_project" class="form-control">
                  <option value="Web">Web</option>
                  <option value="Landing Page">Landing Page</option>
                  <option value="logo">Logo</option>
                  <option value="Brandis">Brandis</option>
                  <option value="Mobile Design">Mobile Design</option>
                  <option value="Dashboard">Dashboard</option>
                  <option value="3D">3D Design</option>
                  <option value="Animation">Animation Design</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Pilih Karyawan Yang akan Mengerjakan:</label>
                <?php foreach ($jenis as $pilihan) : ?>
                  <br>
                  <input type="checkbox" name="pilih_karyawan" alt="Checkbox" value="<?= $pilihan['karyawan_id'] ?>"><?= $pilihan['nama'] ?>
                <?php endforeach; ?>
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
<script>
  function CheckD() {
    var current = new Date(document.getElementById('datapicker').value);
    var today = new Date();
    today = moment.tz(d, "Asia/Jakarta").format();
    // var mindate=d.substring(0, 11) + "00:00";
    if (current.getDate() < today.getDate()) {
      alert("You Can't Assign Task For Expired Date");
      document.getElementById('datapicker').value = "";
    } else {
      return true;
    }
  }


  // $(document).ready(function() {
  //   var d = new Date().toISOString();
  // d = moment.tz(d, "Asia/Jakarta").format();
  //   var minDate = d.substring(0, 11) + "00:00";
  //   Window.alert(minDate);

  //   $(".datetimepicker").attr({
  //     "value": minDate,
  //     "min": minDate,
  //   });
  // });
</script>