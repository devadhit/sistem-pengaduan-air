<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Pengaduan</h1>

	<a href="<?= base_url('Alternatif'); ?>" class="btn btn-secondary btn-icon-split"><span
			class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-edit"></i> Edit Data Pengaduan</h6>
	</div>

	<?php echo form_open('Alternatif/update/' . $alternatif->id_alternatif); ?>
	<div class="card-body">
		<div class="row">
			<?php echo form_hidden('id_alternatif', $alternatif->id_alternatif) ?>
			<div class="form-group col-md-12">
				<label class="font-weight-bold">Tanggal Laporan</label>
				<input autocomplete="off" type="datetime-local" value="<?php echo date('Y-m-d\TH:i', strtotime($alternatif->tgl_laporan)) ?>" name="tgl_laporan" required class="form-control" />
				<small>(Hari/Bulan/Tahun Jam:Menit)</small>
			</div>
			<div class="form-group col-md-12">
				<label class="font-weight-bold">Nama Pelanggan/Pelapor</label>
				<input autocomplete="off" type="text" name="nama" value="<?php echo $alternatif->nama ?>" required
					class="form-control" />
			</div>
			<div class="form-group col-md-12">
				<label class="font-weight-bold">No Telp Pelanggan/Pelapor</label>
				<input required autocomplete="off" type="number" class="form-control" value="<?php echo $alternatif->telp ?>" placeholder="Nomor Telpon"
					name="telp" />
			</div> <br>

			<div class="form-group col-md-12">
				<label class="font-weight-bold">Wilayah Pelanggan/Pelapor</label>
				<select name="id_lokasi" class="form-control">
					<option value="">-- Pilih Wilayah Pelanggan --</option>
					<?php
						foreach($wilayah as $k) {
							$s='';
							if($k->id_lokasi == $alternatif->id_lokasi){
								$s='selected';
							}
					?>
						<option value="<?php echo $k->id_lokasi ?>" <?php echo $s ?>>
							<?php echo $k->nama_lokasi ?>
						</option>
					<?php } ?>
				</select>

			</div> <br>
			<div class="form-group col-md-12">
				<label class="font-weight-bold">Alamat Pelanggan/Pelapor</label>
				<textarea class="form-control" rows="5" placeholder="Alamat Lengkap" name="alamat"><?php echo $alternatif->alamat ?></textarea>
			</div> <br>
			<div class="form-group col-md-12">
				<label class="font-weight-bold">Detail Masalah</label>
				<textarea class="form-control" rows="5" placeholder="Detail Masalah" name="detail_masalah"><?php echo $detail_masalah->detail_masalah ?></textarea>
			</div> <br>
		</div>
	</div>
	<div class="card-footer text-right">
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
		<button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
	</div>
	<?php echo form_close() ?>
</div>

<?php $this->load->view('layouts/footer_admin'); ?>