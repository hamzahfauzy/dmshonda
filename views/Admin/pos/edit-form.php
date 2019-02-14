<?php $this->load("partial.header") ?>
<?php $this->load("partial.nav") ?>
<?php $this->load("partial.content-start") ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><i class="fas fa-map-marker-alt"></i> Pos Dealer</h1>
	<a href="<?= base_url() ?>/admin/pos-list" class="btn btn-sm btn-outline-secondary">
		<i class="fa fa-reply"></i> Kembali
	</a>
</div>

<div>
	<form method="post" action="<?= base_url()?>/admin/pos-list/update" style="width: 350px;">
		<?php if ($error) { ?>
		<div class="alert alert-danger" role="alert">
			Nama pos sudah digunakan.
		</div>						
		<?php } ?>
		<input type="hidden" name="id" value="<?= $pos->id ?>">
		<div class="form-group">
			<label for="nama">Nama Pos</label>
			<input type="text" id="nama" name="nama" placeholder="Nama Pos" required="" class="form-control" value="<?= $pos->nama ?>">
			<span class="form-error nama">Nama Pos tidak boleh kosong</span>
		</div>

		<div class="form-group">
			<label for="alamat">Alamat</label>
			<textarea id="alamat" name="alamat" placeholder="alamat" required="" class="form-control"><?= $pos->alamat ?></textarea>
			<span class="form-error alamat">Alamat tidak boleh kosong</span>
		</div>

		<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
	</form>
</div>
<?php $this->load("partial.content-end") ?>
<?php $this->load("partial.footer") ?>