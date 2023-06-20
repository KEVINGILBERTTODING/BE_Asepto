<div class="row">
	<div class="col-12 grid-margin">
		<div class="card" style="background: #202124;">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col">
						<h4 class="card-title" style="color: #fff;">Edit Data Karyawan</h4>
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

								<div class="col-md-12 text-white">

									<form action="<?php echo base_url(); ?>admin/karyawan/edit/<?= $data->karyawan_id ?>" method="POST" enctype="multipart/form-data">
										<div class="form-group">
											<input type="hidden" class="form-control" name="karyawan_id" value="<?php echo $data->karyawan_id ?>">
										</div>

										<div class="form-group">
											<label for="exampleInputUsername1">Nama Karyawan</label>
											<input type="text" class="form-control" name="karyawan" placeholder="nama karyawan" value="<?php echo $data->nama; ?>" required>
										</div>
										<div class="form-group">
											<label for="exampleInputUsername1">Email</label>
											<input type="text" class="form-control" name="email" placeholder="Alamat email karyawan" value="<?php echo $data->email; ?>" required>
										</div>

										<div class="form-group">
											<label for="exampleInputUsername2">No Telp Karyawan</label>
											<input type="text" class="form-control" name="telp" placeholder="Nomer Telepon karyawan" value="<?php echo $data->telp; ?>" required>
										</div>
										<div class="form-group">
											<label for="exampleInputUsername1">Nomer Rekening Karyawan</label>
											<input type="text" class="form-control" name="norek" placeholder="Nomer Rekening" value="<?php echo $data->norekening; ?>" required>
										</div>
										<div class="form-group">
											<label for="exampleInputUsername1">Nama Bank yang digunakan oleh Karyawan</label>
											<input type="text" class="form-control" name="bank" placeholder="nama bank" value="<?php echo $data->bank; ?>" required>
										</div>

										<div class="form-group">
											<label for="exampleInputUsername1">Jenis Kelamin:</label>
											<select name="jeniskel" class="form-control">
												<option value="">
													<?php if ($jenis['jeniskel'] == 'L') {
														echo "Laki-Laki"
													?>
													<?php } ?>
													<?php if ($jenis['jeniskel'] == 'P') {
														echo "Perempuan"
													?>
													<?php } ?>
												</option>
												<option value="L">Laki-Laki</option>
												<option value="P">Perempuan</option>
											</select>
										</div>
										<div class="form-group">
											<label for="exampleInputUsername1">Posisi Jabatan:</label>
											<select name="jabatan" class="form-control">
												<option value="UI/UX Designer">UI/UX Designer</option>
												<option value="Branding Designer">Branding Designer</option>
												<option value="3D Ilustrator">3D Ilustrator</option>
											</select>
										</div>
										<div class="text-right">
											<button type="submit" class="btn btn-success text-right" name="submitData">Simpan</button>
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