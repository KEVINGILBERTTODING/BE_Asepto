<div class="row">
  <div class="col-md-4 stretch-card grid-margin">
    <div class="card bg-gradient-danger card-img-holder text-white">
      <div class="card-body" style="background: #2c2d30;">
        <a href="<?php echo base_url('karyawan/pembayaran/index') ?>" style="text-decoration: none;">
          <h4 class="font-weight-normal mb-3" style="color:#a9a9a9;">Data Pembayaran<span class="float-none float-sm-right d-block d-sm-inline-block ml-3">
              <img src="<?php echo base_url() ?>/assets/icon_pembayaran.svg ?>"></img>
            </span></h4>
          <h3 class="mb-5" style="font-size:40px; color:#a9a9a9;"> <?php echo $total_penghasilan ?></h3>
        </a>
      </div>
    </div>
  </div>
  <div class="col-md-4 stretch-card grid-margin">
    <div class="card bg-gradient-info card-img-holder text-white">
      <div class="card-body" style="background: #2c2d30;">
        <a href="<?= base_url('karyawan/progress/index') ?>" style="text-decoration: none;">
          <h4 class="font-weight-normal mb-3" style="color:#a9a9a9;">Progress Project <span class="float-none float-sm-right d-block d-sm-inline-block ml-3">
              <img src="<?php echo base_url() ?>/assets/icon_progress_project.svg ?>"></img>
            </span></i></h4>
          <h2 class="mb-5" style="font-size:40px; color:#a9a9a9;"><?php echo $data_progress ?></h2>
        </a>
      </div>
    </div>
  </div>
  <div class="col-md-4 stretch-card grid-margin">
    <div class="card  card-img-holder ">
      <div class="card-body" style="background: #2c2d30;">
        <a href="<?php echo base_url('karyawan/feedback/index'); ?>" style="text-decoration: none;">
          <h4 class="font-weight-normal mb-3" style="color:#a9a9a9;">Feedback<span class="float-none float-sm-right d-block d-sm-inline-block ml-3">
              <img src="<?php echo base_url() ?>/assets/icon_feedback.svg ?>"></img>
            </span></h4>
          <h2 class="mb-5" style="font-size:40px; color:#a9a9a9;"><?php echo $riwayat_feedback ?></h2>
        </a>
      </div>
    </div>
  </div>
</div>


<?php if (!empty($dataProject)) { ?>
  <?php
  $tgl_mulai_timestamp = strtotime($dataProject->tgl_mulai);
  $tgl_selesai_timestamp = strtotime($dataProject->tgl_selesai);
  $now_timestamp = strtotime(date('Y-m-d H:i:s'));
  $deadline_timestamp = $tgl_mulai_timestamp + $tgl_selesai_timestamp;
  if (intval(date('j M Y, H:i:s', $deadline_timestamp)) <= intval(date('j M Y, H:i:s', $now_timestamp))) { ?>

    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">DEADLINE</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Ada Data Project Yang Harus Diselesaikan !!!
          </div>
          <div class="modal-footer">
            <a href="<?= base_url('karyawan/ProjectKaryawan'); ?>" class="btn btn-primary">Cek</a>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
<?php } ?>