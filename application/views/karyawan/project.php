<div class="row">
  <div class="col-12 grid-margin">
    <div class="card" style="background: #2c2d30;">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col">
            <h4 class="card-title" style="color: #fff;">Data Project Masuk</h4>
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
              </tr>
            </thead>
            <tbody>



              <?php
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
                  if ($row->tgl_mulai > $row->tgl_selesai) {
                    echo 'Tanggal Selesai belum ditentukan';
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