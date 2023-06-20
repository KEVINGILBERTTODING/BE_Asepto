<div class="row">
  <div class="col-12 grid-margin">
    <div class="card" style="background: #2c2d30;">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col">
            <h4 class="card-title" style="color: #fff;">Data Project</h4>
          </div>
        </div>
        <div class="table-responsive text-white">
          <table class="table table-bordered table-hovered table-responsive" id="table">
            <thead>
              <tr style="color: #fff;">
                <th width="5%">No</th>
                <th width="10%">Nama Project</th>
                <th width="10%">Deskripsi Project</th>
                <th width="10%">Nama Perusahaan</th>
                <th width="10%">Email Perusahaan</th>
                <th width="10%">Tipe Perusahaan</th>
                <th width="10%">Tanggal Project Dimulai</th>
                <th width="10%">Tanggal Project Selesai</th>
                <th width="10%">Status</th>
                <th width="10%">Hasil Project</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $count = 0;
              // $dataProject = is_array($dataProject) ? $dataProject : array($dataProject);
              foreach ($dataProject as $row) {
                $count = $count + 1;
                if ($row->status == 1) {
                  echo '<tr style="color: #fff;">';
                  echo '<td>' . $count . '</td>';
                  echo '<td>' . $row->nama_project . '</td>';
                  echo '<td>' . $row->deskripsi_project . '</td>';
                  echo '<td>' . $row->nama_perusahaan . '</td>';
                  echo '<td>' . $row->email_perusahaan . '</td>';
                  echo '<td>' . $row->tipe_perusahaan . '</td>';
                  echo '<td>' . $row->tgl_mulai . '</td>';
                  echo '<td>' . $row->tgl_selesai . '</td>';
                  echo '<td>';
                  if ($row->status == 1) {
                    echo '<p class="badge badge-info">Sudah Selesai</p>';
                  } else {
                    echo '<p class="badge badge-danger">Sedang Dikerjakan</p>';
                  };
                  '</td>';
                  echo '<td>';
                  echo '<img class="mt-2"src="' . base_url("/assets/uploads/project/ ")  . '"></img>';
                  '</td>';
                  echo '</tr>';
                } else {
                  echo '<tr style="color: #fff;">';
                  echo '<td></td>';
                  echo '<td></td>';
                  echo '<td></td>';
                  echo '<td></td>';
                  echo '<td></td>';
                  echo '<td></td>';
                  echo '<td></td>';
                  echo '<td></td>';
                  echo '<td></td>';
                  echo '<td></td>';
                  echo '</tr>';
                }
              ?>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Upload image project-->
<div class="modal fade" id="uploadProject" tabindex="-1" role="dialog" aria-labelledby="loginpesertaLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-black" id="exampleModalLabel">Upload Project yang telah Selesai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin/project/uploadImageProject/') . $row->project_id ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for=""><b>Upload Project</b></label>
            <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="gambar_project">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Ubah</button>
        </div>
        <?php echo $this->session->flashdata('gagal diupdate'); ?>
      </form>
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