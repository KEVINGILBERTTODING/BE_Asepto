<div class="row">
  <div class="col-12 grid-margin">
    <div class="card" style="background: #2c2d30;">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col">
            <h4 class="card-title" style="color: #fff;">Data Project</h4>
          </div>
          <div class="col text-right">
            <a href="<?= base_url('admin/Project/tambah') ?>" class="btn btn-primary">Tambah</a>
          </div>
        </div>
        <div class="table-responsive" style="color:#9DA9A9;">
          <table class="table table-bordered table-hovered table-responsive" id="table">
            <thead>
              <tr style="color: #9DA9A9;">
                <th width="5%">No</th>
                <th>Nama Project</th>
                <th>Deskripsi Project</th>
                <th>Nama Perusahaan</th>
                <th>Email Perusahaan</th>
                <th>Tipe Perusahaan</th>
                <th>Tanggal Project Dimulai</th>
                <th>Tanggal Project Selesai</th>
                <th>Status</th>
                <th width="15%">Aksi</th>
              </tr>
            </thead>
            <tbody>



              <?php
              date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
              $now = date('Y-m-d H:i:s');
              $count = 0;
              foreach ($dataProject as $row) {
                $count = $count + 1;

              ?>
                <tr style="color: #9DA9A9;">
                  <td align="center"><?= $count ?></td>
                  <td><?= $row->nama_project ?></td>
                  <td><?= $row->deskripsi_project ?></td>
                  <td><?= $row->nama_perusahaan ?></td>
                  <td><?= $row->email_perusahaan ?></td>
                  <?php
                  echo '<td>';
                  if ($row->tipe_perusahaan == 'Big') {
                    echo 'Perusahaan Besar';
                  } else {
                    echo 'Perusahaan Kecil';
                  }
                  '</td>';
                  ?>
                  <td><?= $row->tgl_mulai ?></td>
                  <?php
                  echo '<td>';
                  if (date('j M Y, H:i:s', strtotime($row->tgl_mulai)) > date('j M Y, H:i:s', strtotime($row->tgl_selesai))) {
                    echo 'Tanggal Selesai belum ditentukan';
                  } elseif (strtotime($row->tgl_mulai) + strtotime($now) <= strtotime($row->tgl_selesai)) {
                    echo '<p class="badge badge-danger">Deadline</p>';
                  } else {
                    echo '<p>' . $row->tgl_selesai . '</p>';
                  }
                  '</td>';
                  ?>
                  <td>
                    <?php
                    if ($row->status == 1) {
                      echo '<p class="badge badge-success">Sudah Selesai</p>';
                    } else {
                      echo '<p class="badge badge-danger">Sedang Dikerjakan</p>';
                    }
                    ?>
                  </td>

                  <td align="center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="<?= base_url('admin/project/edit/') . $row->project_id; ?>" class="btn btn-warning btn-sm mr-3">
                        <i class="mdi mdi-tooltip-edit"></i>
                      </a>
                      <a href="<?= base_url('admin/project/deleteProject/') . $row->project_id; ?>" onclick="return confirm('Yakin Hapus data')" class="btn btn-danger btn-sm">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://rawgit.com/dimsemenov/Magnific-Popup/master/dist/jquery.magnific-popup.js"></script>
<script>
  $(document).ready(function() {
    $(".FlowerLink").each(function() {
      $(this).wrap("<a class=\"FlowerLinkWrapper\" href=\"" + $(this).attr('src') + "\"></a>");
    });
    $('.FlowerLinkWrapper').magnificPopup({
      type: 'image',
      closeOnContentClick: true,
      image: {
        verticalFit: true
      },
      zoom: {
        enabled: true,
        duration: 800 // don't foget to change the duration also in CSS
      }
    });
  });
</script>