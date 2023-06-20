<div class="row">
	<div class="col-12 grid-margin">
		<div class="card" style="background: #202124;">
			<div class="card-body">
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

								<div class="col-md-12">

									<form action="<?php echo base_url(); ?>/karyawan/Progress/edit/<?= $data->progress_id ?>" method="POST" enctype="multipart/form-data">
										<div class="form-group text-white">
											<input type="hidden" class="form-control" name="karyawan_id" placeholder="name" value="<?= $user->karyawan_id ?>" required>
											<label for="exampleInputUsername1">Edit Progress</label>
											<textarea name="progress" placeholder="Masukan Progress" class="form-control texteditor"></textarea>
										</div>
										<div class="form-group text-white">
											<label for="exampleInputUsername1">Nama Project:</label>
											<select name="project_id" class="form-control">
												<option value="">--Nama Project--</option>
												<?php foreach ($jenis as $pilihan) : ?>
													<option value="<?= $pilihan['project_id'] ?>"><?= $pilihan['nama_project'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="form-group">
											<label for="exampleInputUsername1">Progress Pekerjaan:</label>
											<select name="progress" class="form-control">
												<option value="25%">25%</option>
												<option value="50%">50%</option>
												<option value="75%">75%</option>
												<option value="100%">100%</option>
											</select>
										</div>
										<div class="text-right">
											<button type="submit" class="btn btn-success text-right" name="submitData">Simpan</button>
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