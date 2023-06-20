<div class="row">
	<div class="col-12 grid-margin">
		<div class="card" style="background: #202124;">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col">
						<h4 class="card-title" style="color: #fff;">Edit Data Project</h4>
					</div>
					<div class="col text-right">
						<a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Kembali</a>
					</div>
				</div>
				<div class="row">

					<div class="col-md-12">

						<!-- TABS -->
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Edit Data Project</button>
							</li>

							<li class="nav-item" role="presentation">
								<button type="button" data-toggle="modal" data-target="#uploadProject" class="nav-link active">Upload Gambar</button>
							</li>
						</ul>
						<!-- END TABS -->

						<!-- CONTENT TABS -->
						<div class="tab-content" id="myTabContent" style="background: #2c2d30;">
							<!-- EDIT DATA KARYAWAN -->
							<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

								<div class="col-md-12" style="color: #fff;">

									<form action="<?php echo base_url(); ?>admin/Project/edit/<?= $data->project_id ?>" method="POST" enctype="multipart/form-data">
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
											<input required type="datetime-local" class="form-control" name="tgl_selesai" value="<?php echo $data->tgl_selesai; ?>" required>
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
												<label for="exampleInputUsername1">Nominal Budget</label>
												<input type="text" class="form-control" name="budget" placeholder="Masukan Budget Project" value="" required>
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
												<label for="exampleInputUsername1">Pilih Karyawan Yang akan Mengerjakan:</label>
												<?php foreach ($jenis as $pilihan) : ?>
													<br>
													<input type="checkbox" name="pilih_karyawan" alt="Checkbox" value="<?= $pilihan['karyawan_id'] ?>"><?= $pilihan['nama'] ?>
												<?php endforeach; ?>
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

							<!-- GAMBAR PRODUK -->
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
										<form action="<?php echo base_url(); ?>admin/Project/uploadImageProject/<?= $data->project_id ?>" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="form-group">
													<input type="hidden" class="form-control" name="project_id" value="<?php echo $data->project_id ?>">
												</div>
												<div class="form-group">
													<label for=""><b>Upload Project</b></label>
													<input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="gambar_project">
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-remove" aria-hidden="true"></i> Batal</button>
												<button type="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Ubah</button>
											</div>
											<?php echo $this->session->flashdata('gagal diupdate'); ?>
										</form>
									</div>
								</div>
							</div>

						</div>
						<!-- END CONTENT TABS -->

					</div>

				</div>
			</div>
		</div>
	</div>
</div>