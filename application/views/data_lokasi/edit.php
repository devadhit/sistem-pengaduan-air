<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-map"></i> Data Wilayah</h1>

	<a href="<?= base_url('Data_Lokasi'); ?>" class="btn btn-secondary btn-icon-split"><span
			class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-edit"></i> Edit Data Wilayah</h6>
	</div>

	<?php echo form_open('Data_Lokasi/update/' . $kriteria->id_lokasi); ?>
	<div class="card-body">
		<div class="row">
			<?php echo form_hidden('id_lokasi', $kriteria->id_lokasi) ?>


			<div class="form-group col-md-12">
				<label class="font-weight-bold">Nama Wilayah</label>
				<input autocomplete="off" type="text" name="nama_lokasi" value="<?php echo $kriteria->nama_lokasi ?>"
					required class="form-control" />
			</div>
		</div>
	</div>
	<div class="card-footer text-right">
		<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
		<button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
	</div>
	<?php echo form_close() ?>
</div>

<?php $this->load->view('layouts/footer_admin'); ?>