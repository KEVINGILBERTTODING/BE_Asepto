<div class="row">
	<div class="col-12 grid-margin">
		<div class="card">
			<div class="card-body" style="background: #202124;">
				<div class="row mb-3">
					<div class="col">
						<h4 class="card-title" style="color: #fff;">Edit Data Feedback</h4>
					</div>
					<div class="col text-right">
						<a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-primary">Kembali</a>
					</div>
				</div>
				<div class="row">

					<div class="col-md-12">

						<!-- CONTENT TABS -->
						<div class="tab-content" id="myTabContent">
							<!-- EDIT DATA FEEDBACK -->
							<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

								<div class="col-md-12" style="color: #fff;">

									<form action="<?php echo base_url('/admin/Feedback/edit/') . $data->feedback_id; ?>" method="POST" enctype="multipart/form-data">
										<div class="form-group">
											<input type="hidden" class="form-control" name="feedack_id" value="<?php echo $data->feedback_id ?>">
										</div>
										<div class="form-group">
											<label for="exampleInputUsername1">Tambahkan Feedback untuk Karyawan</label>
											<textarea name="feedback" placeholder="Masukan feedback" class="form-control texteditor"></textarea>
										</div>
										<div class="form-group">
											<label for="exampleInputUsername1">Nama Project:</label>
											<select name="tipe" class="form-control">
												<?php foreach ($jenis as $pilihan) : ?>
													<option value="<?= $pilihan['nama_project'] ?>"><?= $pilihan['nama_project'] ?></option>
												<?php endforeach; ?>
												<option value="<?php $pilihan['nama_project'] ?>"><?php $pilihan['nama_project'] ?></option>
											</select>
										</div>
										<div class="text-right">
											<button type="submit" class="btn btn-success text-right" name="submitData">Simpan</button>
										</div>
									</form>
								</div>
							</div>
							<!--END DATA FEEDBACK -->

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