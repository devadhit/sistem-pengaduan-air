<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-file"></i> Data SOP dan Instruksi Kerja</h1>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Daftar Data SOP dan Instruksi Kerja
		</h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class="bg-primary text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Jenis Pengaduan</th>
						<th>File SOP</th>
						<th>File Instruksi Kerja</th>

						<?php if ($this->session->userdata('id_user_level') == 1): ?>
							<th width="15%">Aksi</th>
						<?php endif ?>

					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach ($list as $data => $value) {
						?>
						<?php if ($value->deskripsi != 'Tidak Ada') { ?>
						<tr align="center">
							<td>
								<?= $no ?>
							</td>
							<td align="left">
								<?php echo $value->deskripsi ?>
							</td>
							<td>
								<?php if ($value->file_sop != '-') {
									echo anchor('uploads/' . $value->file_sop, 'Unduh File SOP');
								} else {
									echo '-';
								} ?>
							</td>
							<td>
								<?php if ($value->file_sop != '-') {
									echo anchor('uploads/' . $value->file_ik, 'Unduh File Instruksi Kerja');
								} else {
									echo '-';
								} ?>
							</td>
							<?php if ($this->session->userdata('id_user_level') == 1): ?>
								<td>
									<div class="btn-group" role="group">
										<a data-toggle="tooltip" data-placement="bottom" title="Edit Data"
											href="<?= base_url('SOP/edit/' . $value->id_sop) ?>"
											class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit File</a>
										<!-- <a data-toggle="tooltip" data-placement="bottom" title="Hapus Data"
										href="<?= base_url('SOP/destroy/' . $value->id_sop) ?>"
										onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')"
										class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> -->
									</div>
								</td>
							<?php endif ?>
						</tr>
						<?php }
						$no++;
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<?php $this->load->view('layouts/footer_admin'); ?>