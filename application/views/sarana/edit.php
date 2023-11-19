<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-toolbox"></i> Data Sarana</h1>

	<a href="<?= base_url('Sarana'); ?>" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-edit"></i> Edit Data Sarana</h6>
    </div>
	
	<?php echo form_open('Sarana/update/'.$sarana->id_sarana); ?>
		<div class="card-body">
			<div class="row">
				<?php echo form_hidden('id_sarana', $sarana->id_sarana) ?>
				<div class="form-group col-md-6">
					<label class="font-weight-bold">Tanggal</label>
					<input autocomplete="off" type="date" name="tanggal" value="<?php echo $sarana->tanggal ?>" required class="form-control"/>
				</div>
				
				<div class="form-group col-md-6">
					<label class="font-weight-bold">Nama Sarana</label>
					<input autocomplete="off" type="text" name="nama_sarana" value="<?php echo $sarana->nama_sarana ?>" required class="form-control"/>
				</div>
				
				<div class="form-group col-md-6">
					<label class="font-weight-bold">Status</label>
					<select name="status" class="form-control" required>
						<option value="baik" <?php if($sarana->status == "baik"){ echo 'selected'; } ?>>Baik</option>
						<option value="rusak" <?php if($sarana->status == "rusak"){ echo 'selected'; } ?>>Rusak</option>						
					</select>
				</div>
			</div>
		</div>
		<div class="card-footer text-right">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
            <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
        </div>
	<?php echo form_close() ?>
</div>

<?php $this->load->view('layouts/footer_admin'); ?>