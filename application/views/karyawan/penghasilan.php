<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col">
            <h4 class="card-title">Data Hasil Pembayaran oleh Panitia</h4>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-hovered" id="table">
            <thead>
              <tr>
                <th width="5%">No</th>
                <th>Id Produk</th>
                <th>Bukti Transfer</th>
                <th>Nominal yang Dibayar</th>
                <th>Nama Panitia</th>
              </tr>
            </thead>
            <tbody>
              <tr>

                <?php
                $count = 0;
                foreach ($RiwayatTransfer as $row) {
                  $count = $count + 1;

                ?>
                  <td align="center"><?php echo $count ?></td>
                  <td><?php echo $row->lelang_id ?></td>
                  <td><img src="<?php echo base_url() ?>./vendors/uploads/panitia/buktitransfer/<?php echo $row->bukti_transfer ?>" alt="" class="rounded mx-auto d-block FlowerLink"></td>
                  <td><?php echo $row->nominal_dibayarkan ?></td>
                  <td><?php echo $row->nama ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>