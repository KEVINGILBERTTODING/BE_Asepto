<div class="row">
  <div class="col-12 grid-margin">
    <div class="card" style="background: #2c2d30;">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col">
            <h4 class="card-title" style="color: #fff;">Review Feedback</h4>
          </div>
        </div>
        <div class="table-responsive text-white">
          <table class="table table-bordered table-hovered" id="table">
            <thead>
              <tr style="color: #9DA9A9;">
                <th width="5%">No</th>
                <th>Nama Project</th>
                <th>Feedback</th>
              </tr>
            </thead>
            <tbody>
              <tr style="color: #9DA9A9;">

                <?php
                $count = 0;
                foreach ($dataFeedback as $row) {
                  $count = $count + 1;

                ?>
                  <td align="center" style="color:#9DA9A9;"><?php echo $count ?></td>
                  <td style="color:#9DA9A9;"><?php echo $row->nama_project ?></td>
                  <td style="color:#9DA9A9;"><?php echo $row->feedback ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>