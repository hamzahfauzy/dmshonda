<?php $this->load("partial.header") ?>
<?php $this->load("partial.nav") ?>
<?php $this->load("partial.content-start") ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><i class="fas fa-list-alt"></i> Kategori</h1>
	<a href="<?= base_url() ?>/admin/kategori-list" class="btn btn-sm btn-outline-secondary">
		<i class="fa fa-reply"></i> Kembali
	</a>
</div>

<div>
	<form method="post" action="<?= base_url()?>/admin/kategori-list/insert" style="width: 350px;">
		<?php if ($error) { ?>
		<div class="alert alert-danger" role="alert">
			Kategori sudah ada.
		</div>						
		<?php } ?>
		<div class="form-group">
			<label for="nama">Kategori</label>
			<input type="text" id="nama" name="nama" placeholder="Nama Kategori" required="" class="form-control" value="<?= old('nama') ?>">
			<span class="form-error nama">Kategori tidak boleh kosong</span>
		</div>

		<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
	</form>
</div>
<?php $this->load("partial.content-end") ?>
<?php $this->load("partial.footer") ?>