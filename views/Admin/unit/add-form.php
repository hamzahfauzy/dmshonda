<?php $this->load("partial.header") ?>
<?php $this->load("partial.nav") ?>
<?php $this->load("partial.content-start") ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><i class="fas fa-motorcycle"></i> Unit Sepeda Motor</h1>
	<a href="<?= base_url() ?>/admin/unit-list" class="btn btn-sm btn-outline-secondary">
		<i class="fa fa-reply"></i> Kembali
	</a>
</div>

<div>
	<form method="post" action="<?= base_url()?>/admin/unit-list/insert" style="width: 350px;">
		<?php if ($error) { ?>
		<div class="alert alert-danger" role="alert">
			Nomor Mesin sudah ada.
		</div>						
		<?php } ?>
		<div class="form-group">
			<label for="jenis">Jenis Sepeda Motor</label>
			<select class="form-control" id="jenis" name="jenis_id" required="">
				<option value="">Pilih Jenis</option>
				<?php foreach ($jenis as $key => $value) { ?>
				<option value="<?= $value->id ?>" <?= old('jenis_id') == $value->id ? 'selected=""' : '' ?>><?= $value->nama ?></option>
				<?php } ?>
			</select>
			<span class="form-error jenis">Jenis Sepeda Motor tidak boleh kosong</span>
		</div>
		<div class="form-group">
			<label for="no_mesin">No Mesin</label>
			<input type="text" id="no_mesin" name="no_mesin" placeholder="No Mesin" required="" class="form-control" value="<?= old('no_mesin') ?>">
			<span class="form-error no_mesin">No Mesin tidak boleh kosong</span>
		</div>
		<div class="form-group">
			<label for="warna">Warna</label>
			<input type="text" id="warna" name="warna" placeholder="Warna" required="" class="form-control" value="<?= old('warna') ?>">
			<span class="form-error warna">Warna tidak boleh kosong</span>
		</div>
		<div class="form-group">
			<label for="nomor_rangka">Nomor Rangka</label>
			<input type="text" id="nomor_rangka" name="nomor_rangka" placeholder="Nomor Rangka" required="" class="form-control" value="<?= old('nomor_rangka') ?>">
			<span class="form-error nomor_rangka">Nomor Rangka tidak boleh kosong</span>
		</div>

		<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
	</form>
</div>
<?php $this->load("partial.content-end") ?>
<?php $this->load("partial.footer") ?>