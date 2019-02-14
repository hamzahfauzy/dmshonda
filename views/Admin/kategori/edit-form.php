<?php $this->load("partial.header") ?>
<?php $this->load("partial.nav") ?>
<?php $this->load("partial.content-start") ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><i class="fas fa-map-marker-alt"></i> Pos Dealer</h1>
	<a href="<?= base_url() ?>/admin/kategori-list" class="btn btn-sm btn-outline-secondary">
		<i class="fa fa-reply"></i> Kembali
	</a>
</div>

<div>
	<form method="post" action="<?= base_url()?>/admin/kategori-list/update" style="width: 350px;">
		<?php if ($error) { ?>
		<div class="alert alert-danger" role="alert">
			Kategori sudah ada.
		</div>						
		<?php } ?>
		<input type="hidden" name="id" value="<?= $kategori->id ?>">
		<div class="form-group">
			<label for="nama">Kategori</label>
			<input type="text" id="nama" name="nama" placeholder="Nama Kategori" required="" class="form-control" value="<?= $kategori->nama ?>">
			<span class="form-error nama">Kategori tidak boleh kosong</span>
		</div>

		<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
	</form>
</div>
<?php $this->load("partial.content-end") ?>
<?php $this->load("partial.footer") ?>