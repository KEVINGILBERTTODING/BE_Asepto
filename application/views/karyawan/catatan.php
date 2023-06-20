<div class="row">
  <div class="col-12 grid-margin">
    <div class="card" style="background: #2c2d30;">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col">
            <h4 class="card-title" style="color: #fff;">Catatan Tambahan</h4>
          </div>
        </div>
        <div class="table-responsive text-white">
          <table class="table table-bordered table-hovered table-responsive" id="table">
            <thead>
              <tr style="color:#9DA9A9;">
                <th width="5%">No</th>
                <th width="100%">Catatan Tambahan</th>
                <th width="70%">Tanggal Pemberitahuan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $count = 0;
              foreach ($dataCatatan as $row) {
                $count = $count + 1;

              ?>
                <tr style="color: #9DA9A9;">
                  <td align="center"><?= $count ?></td>
                  <td><?= $row->catatan ?></td>
                  <td><?php echo date("j M Y", strtotime($row->tanggal_event)); ?></td>
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
      $(document).ready(function()
{
    $(".FlowerLink").each(function()
    {
        $(this).wrap("<a class=\"FlowerLinkWrapper\" href=\"" + $(this).attr('src') + "\"></a>");
    });
    $('.FlowerLinkWrapper').magnificPopup(
    {
        type: 'image',
        closeOnContentClick: true,
        image:
        {
            verticalFit: true
        },
        zoom:
        {
            enabled: true,
            duration: 800 // don't foget to change the duration also in CSS
        }
    });
});
    </script>
