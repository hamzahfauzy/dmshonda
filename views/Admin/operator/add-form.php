<?php $this->load("partial.header") ?>
<?php $this->load("partial.nav") ?>
<?php $this->load("partial.content-start") ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><i class="fas fa-user-tie"></i> Operator</h1>
	<a href="<?= base_url() ?>/admin/operator-list" class="btn btn-sm btn-outline-secondary">
		<i class="fa fa-reply"></i> Kembali
	</a>
</div>

<div>
	<form method="post" action="<?= base_url()?>/admin/operator-list/insert" style="width: 350px;">
		<?php if ($error) { ?>
		<div class="alert alert-danger" role="alert">
			Username sudah digunakan.
		</div>						
		<?php } ?>
		<div class="form-group">
			<label for="nama">Nama Lengkap</label>
			<input type="text" id="nama" name="nama" placeholder="Nama Lengkap" required="" class="form-control" value="<?= old('nama') ?>" value="<?= old('nama') ?>">
			<span class="form-error nama">Nama Lengkap tidak boleh kosong</span>
		</div>

		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" id="username" name="username" placeholder="Username" required="" class="form-control" value="<?= old('username') ?>">
			<span class="form-error username">Username tidak boleh kosong</span>
		</div>

		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" id="password" name="password" placeholder="Password" required="" class="form-control">
			<span class="form-error password">Password tidak boleh kosong</span>
		</div>

		<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
	</form>
</div>
<?php $this->load("partial.content-end") ?>
<?php $this->load("partial.footer") ?>