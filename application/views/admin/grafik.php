<div class="row">
	<div class="col-12 grid-margin">
		<div class="card" style="background: #2c2d30;">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col">
						<h4 class="card-title" style="color: #fff;">Grafik Progress Pekerjaan</h4>
					</div>
				</div>
				<div class="">
					<form method="get" action="">
						<div class="form-group">
							<label for="proyek">Proyek</label>
							<select name="proyek" id="proyek" class="form-control" required="required">
								<option value="">--- Pilih Proyek ---</option>
								<?php foreach ($projects as $project) : ?>
									<?php if (is_null($data_project)) : ?>
										<option value="<?= $project->project_id; ?>"><?= $project->nama_project; ?></option>
									<?php else : ?>
										<option value="<?= $project->project_id; ?>" <?= $project->project_id == $data_project->project_id ? 'selected' : ''; ?>><?= $project->nama_project; ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
						<button type="submit" class="btn btn-primary btn-sm float-right"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
						<?php if (is_null($hidden)) : ?>
							<button type="button" class="btn btn-secondary btn-sm float-right mr-2" onclick="document.getElementById('btn-clear').click()"><i class="fa fa-remove" aria-hidden="true"></i> Clear</button>

							<a id="btn-clear" href="<?= base_url('admin/Riwayat/grafik'); ?>" role="button"></a>
						<?php endif; ?>
					</form>
				</div>
				<div id="graphic">
					<canvas id="bar-chart" <?= $hidden; ?> width="800" height="450"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if (!is_null($karyawan)) : ?>
	<?php $data_karyawan = []; ?>
	<?php $data_keterangan_karyawan = []; ?>
	<?php foreach ($karyawan as $d_karyawan) : ?>
		<?php $nama_karyawan = explode('__', $d_karyawan)[0]; ?>
		<?php // $keterangan_karyawan = explode('__', $d_karyawan)[1];
		?>
		<?php $keterangan_karyawan = $d_karyawan; ?>
		<?php $data_karyawan[] = $nama_karyawan; ?>
		<?php $data_keterangan_karyawan[] = $keterangan_karyawan; ?>
		<?php // var_dump($karyawan);
		?>
		<?php // die;
		?>
	<?php endforeach; ?>
<?php endif; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="https://rawgit.com/dimsemenov/Magnific-Popup/master/dist/jquery.magnific-popup.js"></script>
<script>
	$(document).ready(function() {
		$(".FlowerLink").each(function() {
			$(this).wrap("<a class=\"FlowerLinkWrapper\" href=\"" + $(this).attr('src') + "\"></a>");
		});
		$('.FlowerLinkWrapper').magnificPopup({
			type: 'image',
			closeOnContentClick: true,
			image: {
				verticalFit: true
			},
			zoom: {
				enabled: true,
				duration: 800 // don't foget to change the duration also in CSS
			}
		});
	});

	// Bar chart
	let namaProyek = "<?= $data_project->nama_project; ?>";
	let karyawan = "<?= implode(",", $data_karyawan); ?>".split(",");
	let keterangan_karyawan = "<?= implode(",", $data_keterangan_karyawan); ?>".split(",");
	let data = "<?= implode(",", $progress_karyawan); ?>".split(",");
	new Chart(document.getElementById("bar-chart"), {
		type: 'bar',
		data: {
			// labels: ["Karyawan A", "Karyawan B", "Karyawan C", "Karyawan D", "Karyawan E"],
			labels: karyawan,
			datasets: [{
				label: "Progress",
				backgroundColor: "#3e95cd",
				data: data,
			}]
		},
		options: {
			maintainAspectRatio: true,
			tooltips: {
				enabled: true,
				mode: 'single',
				callbacks: {
					label: function(tooltipItem, data) {
						var allData = data.datasets[tooltipItem.datasetIndex].data;
						var tooltipLabel = data.labels[tooltipItem.index];
						var tooltipData = allData[tooltipItem.index];
						// console.log();
						const xLabel = tooltipItem.xLabel;
						const found = keterangan_karyawan.find(element => element.includes(xLabel)).split('__')[1];
						// console.log(keterangan_karyawan)
						console.log(found)
						return `${found[found.length-1] === "." ? found : found + '.'} Progress: ${tooltipData}%`
					}
				}
			},
			legend: {
				display: false
			},
			title: {
				display: true,
				text: 'Progress pekerjaan "' + namaProyek + '" (persentase)'
			},
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true,
						min: 0,
						max: 100, // Your absolute max value
						stepSize: 25,
						callback: function(value) {
							return value + '%'; // convert it to percentage
						},
					},
					scaleLabel: {
						display: true,
						labelString: 'Progress pekerjaan "' + namaProyek + '" (%)',
					},
				}]
			}
		}
	});
</script>