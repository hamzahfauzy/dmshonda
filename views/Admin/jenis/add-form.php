<?php $this->load("partial.header") ?>
<?php $this->load("partial.nav") ?>
<?php $this->load("partial.content-start") ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><i class="fas fa-book"></i> Jenis</h1>
	<a href="<?= base_url() ?>/admin/jenis-list" class="btn btn-sm btn-outline-secondary">
		<i class="fa fa-reply"></i> Kembali
	</a>
</div>

<div>
	<form method="post" action="<?= base_url()?>/admin/jenis-list/insert" style="width: 350px;">
		<?php if ($error) { ?>
		<div class="alert alert-danger" role="alert">
			Jenis sudah ada.
		</div>						
		<?php } ?>
		<div class="form-group">
			<label for="kategori">Kategori</label>
			<select class="form-control" id="kategori" name="kategori_id" required="">
				<option value="">Pilih Kategori</option>
				<?php foreach ($kategori as $key => $value) { ?>
				<option value="<?= $value->id ?>" <?= old('kategori_id') == $value->id ? 'selected=""' : '' ?>><?= $value->nama ?></option>
				<?php } ?>
			</select>
			<span class="form-error kategori">Kategori tidak boleh kosong</span>
		</div>
		<div class="form-group">
			<label for="nama">Nama</label>
			<input type="text" id="nama" name="nama" placeholder="Nama" required="" class="form-control" value="<?= old('nama') ?>">
			<span class="form-error nama">Nama tidak boleh kosong</span>
		</div>
		<div class="form-group">
			<label for="model">Model</label>
			<input type="text" id="model" name="model" placeholder="Model" required="" class="form-control" value="<?= old('model') ?>">
			<span class="form-error model">Model tidak boleh kosong</span>
		</div>
		<div class="form-group">
			<label for="tahun_pembuatan">Tahun Pembuatan</label>
			<input type="text" id="tahun_pembuatan" name="tahun_pembuatan" placeholder="Tahun Pembuatan" required="" class="form-control" value="<?= old('tahun_pembuatan') ?>">
			<span class="form-error tahun_pembuatan">Tahun Pembuatan tidak boleh kosong</span>
		</div>
		<div class="form-group">
			<label for="isi_silinder">Isi Silinder</label>
			<input type="text" id="isi_silinder" name="isi_silinder" placeholder="Isi Silinder" required="" class="form-control" value="<?= old('isi_silinder') ?>">
			<span class="form-error isi_silinder">Isi Silinder tidak boleh kosong</span>
		</div>

		<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
	</form>
</div>
<?php $this->load("partial.content-end") ?>
<?php $this->load("partial.footer") ?>