<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Hasil Akhir</h1>

	<a href="<?= base_url('Laporan'); ?>" target="_blank" class="btn btn-primary"> <i class="fa fa-print"></i> Cetak
		Data </a>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card shadow mb-4">
			<!-- /.card-header -->
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Hasil Akhir Perankingan</h6>
			</div>

			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" width="100%" cellspacing="0">
						<thead class="bg-success text-white">
							<tr align="center">
								<th width="10%">Nomor Antrian</th>
								<th>Pelapor</th>
								<th>Tanggal Pengaduan</th>
								<th>Nilai Prioritas</th>
								<th width="15%">Rank</th>
								<th width="15%">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($hasil_topsis as $keys): ?>
								<tr align="center">
									<td align="left">
										<?= $keys->id_alternatif ?>
									</td>
									<td align="left">
										<?= $keys->nama ?>
									</td>
									<td>
										<?php echo date('d F Y, H:i', strtotime($keys->tgl_laporan)) ?> WIB
									</td>
									<td>
										<?= $keys->nilai ?>
									</td>
									<td>
										<?= $no; ?>
									</td>
									<td>
									<?php if ($keys->status == 'BELUM_DITANGANI') { ?>
									<a href="<?= base_url('Pengaduan/tangani/' . $keys->id_pengaduan); ?>"
										onclick="return confirm('Tangani Sekarang?')" class="btn btn-warning btn-sm">Tangani
										Sekarang</a>
								    <?php } else if ($keys->status == 'SEDANG_DITANGANI') { ?>
										<a href="<?= base_url('Pengaduan/selesai/' . $keys->id_pengaduan); ?>"
											onclick="return confirm('Sudah Selesai?')" class="btn btn-info btn-sm">Tandai
											Selesai</a>
										<a href="<?= base_url('Pengaduan/belum/' . $keys->id_pengaduan); ?>"
											onclick="return confirm('Batalkan Penanganan?')" class="btn btn-danger btn-sm">Batal
											Ditangani</a>
									<?php } else { ?>
										<a href="<?= base_url('Pengaduan/tangani/' . $keys->id_pengaduan); ?>"
											onclick="return confirm('Belum Selesai?')" class="btn btn-info btn-sm">Kembali
											Ditangani</a>
										<a href="<?= base_url('Pengaduan/belum/' . $keys->id_pengaduan); ?>"
											onclick="return confirm('Batalkan Penanganan?')" class="btn btn-danger btn-sm">Batal
											Ditangani</a>
									<?php } ?>
									</td>
								</tr>
								<?php
								$no++;
							endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>



<?php
$this->load->view('layouts/footer_admin');
?>