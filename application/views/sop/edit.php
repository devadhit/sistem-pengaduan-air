<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-file"></i> Data SOP dan Instruksi Kerja</h1>

	<a href="<?= base_url('SOP'); ?>" class="btn btn-secondary btn-icon-split"><span
			class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-edit"></i> Edit Data SOP dan Instruksi Kerja</h6>
	</div>

	<?php echo form_open_multipart('SOP/update/' . $sop->id_sop); ?>
	<div class="card-body">
		<div class="row">
			<?php echo form_hidden('id_sop', $sop->id_sop) ?>


			<div class="form-group col-md-12">
				<label class="font-weight-bold">Lampiran Surat SOP</label>
				<input autocomplete="off" type="file" name="file_sop" value="<?php echo $sop->file_sop ?>"
					required class="form-control" />
			</div>
			<div class="form-group col-md-12">
				<label class="font-weight-bold">Lampiran Surat Instruksi Kerja</label>
				<input autocomplete="off" type="file" name="file_ik" value="<?php echo $sop->file_ik ?>"
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