<?php $this->load("partial.header") ?>
<?php $this->load("partial.nav") ?>
<?php $this->load("partial.content-start") ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><i class="fas fa-users"></i> Sales</h1>
	<a href="<?= base_url() ?>/admin/sales-list" class="btn btn-sm btn-outline-secondary">
		<i class="fa fa-reply"></i> Kembali
	</a>
</div>

<div>
	<form method="post" action="<?= base_url()?>/admin/sales-list/insert" style="width: 350px;">
		<?php if ($error) { ?>
		<div class="alert alert-danger" role="alert">
			NIK sudah digunakan.
		</div>						
		<?php } ?>
		<div class="form-group">
			<label for="NIK">NIK</label>
			<input type="text" id="NIK" name="NIK" placeholder="NIK" required="" class="form-control" value="<?= old('NIK') ?>">
			<span class="form-error NIK">NIK tidak boleh kosong</span>
		</div>

		<div class="form-group">
			<label for="nama">Nama Lengkap</label>
			<input type="text" id="nama" name="nama" placeholder="Nama Lengkap" required="" class="form-control" value="<?= old('nama') ?>">
			<span class="form-error nama">Nama Lengkap tidak boleh kosong</span>
		</div>

		<div class="form-group">
			<label for="alamat">Alamat</label>
			<textarea id="alamat" name="alamat" placeholder="alamat" required="" class="form-control"><?= old('alamat') ?></textarea>
			<span class="form-error alamat">Alamat tidak boleh kosong</span>
		</div>

		<div class="form-group">
			<label for="telepon">Telepon</label>
			<input type="text" id="telepon" name="telepon" placeholder="Telepon" required="" class="form-control" value="<?= old('telepon') ?>">
			<span class="form-error telepon">Telepon tidak boleh kosong</span>
		</div>

		<div class="form-group">
			<label for="jenis_kelamin">Jenis Kelamin</label>
			<select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required="">
				<option value="">Pilih</option>
				<option value="Laki-laki">Laki-laki</option>
				<option value="Perempuan">Perempuan</option>
			</select>
			<span class="form-error jenis_kelamin">Jenis Kelamin tidak boleh kosong</span>
		</div>

		<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
	</form>
</div>
<?php $this->load("partial.content-end") ?>
<?php $this->load("partial.footer") ?>