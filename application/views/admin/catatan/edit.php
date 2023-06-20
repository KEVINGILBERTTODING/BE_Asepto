<div class="row">
	<div class="col-12 grid-margin">
		<div class="card" style="background: #202124;">
			<div class="card-body ">
				<div class="row mb-3">
					<div class="col">
						<h4 class="card-title" style="color: #fff;">Edit Catatan Tambahan</h4>
					</div>
					<div class="col text-right">
						<a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-primary">Kembali</a>
					</div>
				</div>
				<div class="row">

					<div class="col-md-12">

						<!-- CONTENT TABS -->
						<div class="tab-content" id="myTabContent" style="background: #2c2d30;">
							<!-- EDIT CATATAN TAMBAHAN -->
							<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

								<div class="col-md-12 text-white">

									<form action="<?php echo base_url(); ?>/admin/Catatan/edit/<?= $data->catatan_id ?>" method="POST" enctype="multipart/form-data">
										<div class="form-group">
											<input type="hidden" class="form-control" name="catatan_id" value="<?php echo $data->catatan_id ?>">
										</div>

										<div class="form-group">
											<label for="exampleInputUsername1">Catatan Tambahan</label>
											<textarea name="catatan" placeholder="Masukan Catatan Tambahan" class="form-control texteditor"></textarea>
										</div>
										<div class="form-group">
											<label for="exampleInputUsername1">Tanggal Event</label>
											<input required type="datetime-local" class="form-control" name="tanggal_event" value="">
										</div>
										<div class="text-right">
											<button type="submit" class="btn btn-success mb-3 text-right" name="submitData">Simpan</button>
										</div>
									</form>
								</div>
							</div>
							<!--END CATATAN TAMBAHAN -->
							
						</div>
						<!-- END CONTENT TABS -->

					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<!-- panggil jquery -->
<script type="text/javascript" src="assets/jquery/jquery-3.1.1.min.js"></script>
<!-- panggil ckeditor.js -->
<script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
<!-- panggil adapter jquery ckeditor -->
<script type="text/javascript" src="assets/ckeditor/adapters/jquery.js"></script>
<!-- setup selector -->
<script type="text/javascript">
    $('textarea.texteditor').ckeditor();
</script>
