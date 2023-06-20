<div class="row">
  <div class="col-12 grid-margin">
    <div class="card" style="background: #2c2d30;">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col">
            <h4 class="card-title" style="color: #fff;">Data Progress Pekerjaan</h4>
          </div>
          <div class="col text-right">
            <a href="<?= base_url('karyawan/Progress/tambah') ?>" class="btn btn-primary">Tambah</a>
          </div>
        </div>
        <div class="table-responsive text-white">
          <table class="table table-bordered table-hovered table-responsive" id="table">
            <thead>
              <tr style="color: #fff;">
                <th width="5%">No</th>
                <th width="20%">Nama Project</th>
                <th width="50%">Keterangan Progress</th>
                <th width="20%">Tanggal</th>
                <th width="20%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $count = 0;
              foreach ($dataProgress as $row) {
                $count = $count + 1;

              ?>
                <tr style="color: #fff;">
                  <td align="center"><?= $count ?></td>
                  <td><?= $row->nama_project ?></td>
                  <td><?= $row->keterangan ?></td>
                  <td><?php echo date("j M Y", strtotime($row->tanggal)); ?></td>
                  <td align="center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="<?= base_url('karyawan/progress/edit/') . $row->progress_id; ?>" class="btn btn-warning btn-sm">
                        <i class="mdi mdi-tooltip-edit"></i>
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