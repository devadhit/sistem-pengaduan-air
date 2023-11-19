<?php $this->load->view('layouts/header_admin'); ?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-list"></i> Data Evaluasi
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
<?= $this->session->flashdata('message'); ?>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header justify-content-between">

		<div class="form-group">

		</div>
		<div class="form-group">


		</div>

		<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Data Evaluasi
		</h6>


	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nomor Antrian</th>
						<th>Nama Pelapor</th>
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
								<button type="button" class="btn btn-success" data-toggle="modal"
									data-target="#catatan<?=$value->id_pengaduan?>">
									Update Catatan
								</button>
							</td>
						</tr>

						<div class="modal fade" id="catatan<?=$value->id_pengaduan?>" tabindex="-1" role="dialog"
							aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel"><?=$value->id_pengaduan?></h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
									<?php echo form_open('Pengaduan/update_catatan/'.$value->id_pengaduan); ?>
									<?php echo form_hidden('id_pengaduan', $value->id_pengaduan) ?>
									<label for="">Catatan Evaluasi</label>
									<textarea name="catatan" class="form-control" rows="5"><?=$value->catatan?></textarea>
									
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Save changes</button>
									</div>
									<?php echo form_close() ?>
								</div>
							</div>
						</div>


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