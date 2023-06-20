<div class="row">
	<div class="col-12 grid-margin">
		<div class="card" style="background: #202124;">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col">
						<h4 class="card-title" style="color: #fff;">Edit Data Project</h4>
					</div>
					<div class="col text-right">
						<a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-primary">Kembali</a>
					</div>
				</div>
				<div class="row">

					<div class="col-md-12">

						<!-- CONTENT TABS -->
						<div class="tab-content" id="myTabContent" style="background: #2c2d30;">
							<!-- EDIT DATA KARYAWAN -->
							<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

								<div class="col-md-12" style="color: #fff;">

									<form action="<?php echo base_url(); ?>/admin/project/edit/<?= $data->project_id ?>" method="POST" enctype="multipart/form-data">
										<div class="form-group">
											<input type="hidden" class="form-control" name="project_id" value="<?php echo $data->project_id ?>">
										</div>
										<div class="form-group">
											<label for="exampleInputUsername1">Nama Project</label>
											<input type="text" class="form-control" name="nama_project" placeholder="Nama Project" value="<?php echo $data->nama_project; ?>" required>
										</div>
										<div class="form-group">
											<label for="exampleInputUsername1">Deskripsi Project</label>
											<input type="text" class="form-control" name="deskripsi" placeholder="deskripsi" value="<?php echo $data->deskripsi_project; ?>" required>
										</div>
										<div class="form-group">
											<label for="exampleInputUsername1">Tanggal Dimulai</label>
											<input required type="datetime-local" class="form-control" name="tgl_mulai" value="<?php echo $data->tgl_mulai; ?>">
										</div>
										<div class="form-group">
											<label for="exampleInputUsername1">Tanggal Berakhir</label>
											<input required type="datetime-local" class="form-control" name="tgl_selesai" value="" required>
											<div class="form-group">
												<label for="exampleInputUsername1">Nama Perusahaan</label>
												<input type="text" class="form-control" name="nama_perusahaan" placeholder="Nama Perusahaan" value="<?php echo $data->nama_perusahaan; ?>" required>
											</div>
											<div class="form-group">
												<label for="exampleInputUsername1">Email Perusahaan</label>
												<input type="text" class="form-control" name="email_perusahaan" placeholder="Email Perusahaan" value="<?php echo $data->email_perusahaan; ?>" required>
											</div>
											<div class="form-group">
												<label for="exampleInputUsername1">Tipe Perusahaan:</label>
												<select name="tipe_perusahaan" class="form-control">
													<option value="">
														<?php if ($tipe['tipe_perusahaan'] == 'Small') {
															echo "Perusahaan Kecil"
														?>
														<?php } ?>
														<?php if ($tipe['tipe_perusahaan'] == 'Big') {
															echo "Perusahaan Besar"
														?>
														<?php } ?>
													</option>
													<option value="Small">Perusahaan kecil</option>
													<option value="Big">Perempuan Besar</option>
												</select>
											</div>
											<div class="form-group">
												<label for="exampleInputUsername1">Kategori Project:</label>
												<select name="kategori_project" class="form-control">
													<option value="Web">Web</option>
													<option value="Landing Page">Landing Page</option>
													<option value="logo">Logo</option>
													<option value="Brandis">Brandis</option>
													<option value="Mobile Design">Mobile Design</option>
													<option value="Dashboard">Dashboard</option>
													<option value="3D">3D Design</option>
													<option value="Animation">Animation Design</option>
												</select>
											</div>
											<div class="form-group">
												<label for="exampleInputUsername1">Status Project:</label>
												<select name="status" class="form-control">
													<option value="">
														<?php if ($status['status'] == 0) {
															echo "Sedang Dikerjakan"
														?>
														<?php } ?>
														<?php if ($status['status'] == 1) {
															echo "Sudah Selesai"
														?>
														<?php } ?>
													</option>
													<option value="0">Sedang Dikerjakan</option>
													<option value="1">Sudah Selesai</option>
												</select>
											</div>

											<div class="text-right">
												<button type="submit" class="btn btn-success mb-3 text-right" name="submitData">Simpan</button>
											</div>
									</form>
								</div>
							</div>
							<!--END DATA KARYAWAN -->

						</div>
						<!-- END CONTENT TABS -->

					</div>

				</div>
			</div>
		</div>
	</div>
</div>