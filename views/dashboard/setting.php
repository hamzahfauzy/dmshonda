<?php 
use vendor\zframework\Session; 
?>
<?php $this->load("partial.header") ?>
<?php $this->load("partial.nav") ?>
<?php $this->load("partial.content-start") ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><i class="fa fa-cog"></i> Setting</h1>
</div>
<div class="content" style="max-width: 500px;">
	<form action="<?= base_url()?>/akun/setting" method="post">
		<input type="hidden" name="id" value="<?= $user->id ?>">
		<div class="form-group">
			<label for="nama">Nama Lengkap</label>
			<input type="text" id="nama" name="nama" placeholder="Nama Lengkap" required="" class="form-control" value="<?= Session::user()->nama ?>">
			<span class="form-error nama">Nama Lengkap tidak boleh kosong</span>
		</div>

		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" id="username" name="username" placeholder="Username" required="" class="form-control" value="<?= Session::user()->username ?>" readonly>
		</div>

		<div class="form-group">
			<label for="password">Password (optional)</label>
			<input type="password" id="password" name="password" placeholder="Password" class="form-control">
			<span class="form-error password">Password tidak boleh kosong</span>
		</div>

		<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
	</form>
</div>
<?php $this->load("partial.content-end") ?>
<?php $this->load("partial.footer") ?>