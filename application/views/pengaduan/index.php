<?php $this->load->view('layouts/header_admin'); ?>

<?php
$status = str_replace('_', ' ', $this->input->get('status'));
$tanggal_dibuat = str_replace('_', ' ', $this->input->get('tanggal_dibuat'));
$proses = $this->input->get('status');
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-list"></i> Data Pengaduan -
		<?= $status ?>
	</h1>
	<!-- <a href="<?= base_url('pengaduan/create'); ?>" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Data </a> -->
</div>
<!-- <?php if ($this->session->id_user_level == 3): ?>
	<div class="alert alert-primary" role="alert">
		Anda bertugas di wilayah <b>
			<?= $this->session->nama_lokasi; ?>
		</b>, berikut adalah data pengaduan yang ada di wilayah <b>
			<?= $this->session->nama_lokasi; ?>
		</b>
	</div>
<?php endif; ?> -->
<?php if ($this->session->id_user_level == 3): ?>
	<div class="alert alert-primary" role="alert">
		Silakan ubah status pengaduan dan berikan penilaian masalah sesuai nomor antrian, <a
			href="<?= base_url('Penilaian') ?>"><b>klik disini.</b></a>
	</div>
<?php endif; ?>

<?= $this->session->flashdata('message'); ?>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header justify-content-between">

		<div class="form-group">

		</div>
		<div class="form-group">


		</div>

		<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Pengaduan yang
			<?= $status ?>
		</h6>


	</div>

	<div class="card-body">
		<form method="get" action="" <?= base_url('pengaduan?status' . $this->input->get('status') . '') ?>>
			<div class="row">
				<div class="form-group col-md-5">
					<label for="">Status</label>
					<select name="status" class="form-control">
						<option value="belum_ditangani" <?= $status == 'belum ditangani' ? 'selected' : '' ?>>Belum
							Ditangani
						</option>
						<option value="sedang_ditangani" <?= $status == 'sedang ditangani' ? 'selected' : '' ?>>Sedang
							Ditangani
						</option>
						<option value="sudah_ditangani" <?= $status == 'sudah ditangani' ? 'selected' : '' ?>>Sudah
							Ditangani
						</option>
					</select>
				</div>

				<div class="form-group col-md-5">
					<label for="">Tanggal Pengaduan</label>
					<input type="date" name="tanggal_dibuat" value="<?= $tanggal_dibuat ?>" class="form-control">
				</div>
				<div class=" form-group col-md-2">
					<br>
					<button type="submit" class="btn btn-success btn-block mt-2"><i class="fa fa-search"></i> Cari</button>
				</div>
			</div>
		</form>
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nomor Antrian</th>
						<th>Nama Pelapor</th>
						<th>Lokasi</th>
						<th>Jenis Pengaduan</th>
						<th>SOP</th>
						<th>Instruksi Kerja</th>
						<th>Titik Masalah</th>
						<th>Detail Masalah</th>
						<th>Catatan Evaluasi</th>
						<th>Bukti</th>
						<th>Tanggal</th>
						<th>Aksi</th>
						<!-- <th width="15%">Aksi</th> -->
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach ($list as $data => $value) {
						?>
						<tr align="center">
							<td>
								<?= $no ?>
							</td>
							<td>
								<?php echo $value->no_pelanggan ?>
							</td>
							<td>
								<?php echo $value->nama_pelanggan == '' ? $value->nama_lengkap : $value->nama_pelanggan ?>
							</td>
							<td>
								<?php echo $value->nama_lokasi ?>,
								<?php echo $value->alamat ?>
							</td>
							<td>
								<?php echo $value->jenis_pengaduan == 'Tidak Ada' ? 'Belum Diketahui' : $value->jenis_pengaduan ?>
							</td>
							<td>
								<?php if ($value->sop != '-') {
									echo anchor('uploads/' . $value->sop, 'Lihat SOP');
								} else {
									echo '-';
								} ?>
							</td>
							<td>
								<?php if ($value->ik != '-') {
									echo anchor('uploads/' . $value->ik, 'Lihat Instruksi Kerja');
								} else {
									echo '-';
								} ?>
							</td>
							<td>
								<?php echo $value->tingkat_keparahan == 'Tidak Ada' ? 'Belum Diketahui' : $value->tingkat_keparahan ?>
							</td>
							<td>
								<?php echo $value->detail_masalah ?>
							</td>
							<td>
								<?php echo $value->catatan ?>
							</td>
							<td>
								<?php if ($value->bukti != null) { ?>
									<a href="<?= base_url('uploads/bukti/') . $value->bukti ?>" target="_blank">Lihat Bukti</a>
								<?php } else {
									echo '-';
								} ?>

							</td>
							<td>
								<?php echo date('d F Y', strtotime($value->tanggal_dibuat)) ?>
							</td>
							<td>
								<?php if ($proses == 'belum_ditangani') { ?>
									<a href="<?= base_url('Pengaduan/tangani/' . $value->id_pengaduan); ?>"
										onclick="return confirm('Tangani Sekarang?')" class="btn btn-warning btn-sm">Tangani
										Sekarang</a>
								<?php } else if ($proses == 'sedang_ditangani') { ?>
										<a href="<?= base_url('Pengaduan/selesai/' . $value->id_pengaduan); ?>"
											onclick="return confirm('Sudah Selesai?')" class="btn btn-info btn-sm">Tandai
											Selesai</a>
										<a href="<?= base_url('Pengaduan/belum/' . $value->id_pengaduan); ?>"
											onclick="return confirm('Batalkan Penanganan?')" class="btn btn-danger btn-sm">Batal
											Ditangani</a>
									<?php } else { ?>
										<a href="<?= base_url('Pengaduan/tangani/' . $value->id_pengaduan); ?>"
											onclick="return confirm('Belum Selesai?')" class="btn btn-info btn-sm">Kembali
											Ditangani</a>
										<a href="<?= base_url('Pengaduan/belum/' . $value->id_pengaduan); ?>"
											onclick="return confirm('Batalkan Penanganan?')" class="btn btn-danger btn-sm">Batal
											Ditangani</a>
									<?php } ?>
							</td>
							<!-- <td>
							<div class="btn-group" role="group">
								<a data-toggle="tooltip" data-placement="bottom" title="Tangani Pengaduan Ini" href="<?= base_url('pengaduan/edit/' . $value->id_pengaduan) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
								<a  data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="<?= base_url('pengaduan/destroy/' . $value->id_pengaduan) ?>" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
							</div>
						</td> -->
						</tr>
						<?php
						$no++;
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<?php $this->load->view('layouts/footer_admin'); ?>