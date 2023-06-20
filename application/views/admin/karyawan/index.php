<div class="row">
  <div class="col-12 grid-margin">
    <div class="card" style="background: #2c2d30;">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col">
            <h4 class="card-title" style="color: #fff;">Data Karyawan</h4>
          </div>
          <div class="col text-right">
            <a href="<?= base_url('admin/karyawan/tambah') ?>" class="btn btn-primary">Tambah</a>
          </div>
        </div>
        <div class="table-responsive" style="color:#9DA9A9;">
          <table class="table table-bordered table-hovered table-responsive" id="table">
            <thead>
              <tr style="color:#9DA9A9;">
                <th width="5%">No</th>
                <th width="25%">Nama Lengkap</th>
                <th width="25%">Email</th>
                <th width="25%">Nomer HP</th>
                <th width="25%">Jenis Kelamin</th>
                <th width="25%">Jabatan</th>
                <th width="25%">Aksi</th>
              </tr>
            </thead>
            <tbody>



              <?php
              $count = 0;
              foreach ($dataKaryawan as $row) {
                $count = $count + 1;

              ?>
                <tr style="color: #9DA9A9;">
                  <td align="center"><?= $count ?></td>
                  <td><?= $row->nama ?></td>
                  <td><?= $row->email ?></td>
                  <td><?= $row->telp ?></td>
                  <?php
                  echo '<td>';
                  if ($row->jeniskel == 'L') {
                    echo 'Laki-Laki';
                  } else {
                    echo 'Perempuan';
                  };
                  '</td>';
                  ?>
                  <td><?= $row->jabatan ?></td>
                  <td align="center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="<?= base_url('admin/karyawan/edit/') . $row->karyawan_id; ?>" class="btn btn-warning btn-sm mr-3">
                        <i class="mdi mdi-tooltip-edit"></i>
                      </a>
                      <a href="<?= base_url('admin/karyawan/deleteKaryawan/') . $row->karyawan_id; ?>" onclick="return confirm('Yakin Hapus data')" class="btn btn-danger btn-sm">
                        <i class="mdi mdi-delete-forever"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>