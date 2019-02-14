<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DMS Honda | Login Form</title>
	<link rel="stylesheet" type="text/css" href="<?=$this->assets->get('css/styles.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=$this->assets->get('css/bootstrap.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=$this->assets->get('fontawesome/css/all.css')?>">
</head>
<body>
<div class="container">
	<div class="row justify-content-md-center" style="padding-left: 15px; padding-right: 15px;">
		<div style="width: 400px;margin:auto;">
			<br>
			<br>
			<center>
			<img src="<?=$this->assets->get('images/Honda_logo.svg')?>" height="150">
			</center>
			<br>
			<div class="card" style="width: 100%;">
				<div class="card-header">
					<h2 align="center">Login Form</h2>
				</div>
				<div class="card-body">
					<?php if ($error) { ?>
						<div class="alert alert-danger" role="alert">
						  <?= $error ?> tidak cocok dengan database.
						</div>						
					<?php } ?>
					
					<form method="post" action="<?= base_url(); ?>/login">
						<label>Username</label>
						<input type="text" name="username" class="form-control" placeholder="username..." required value="<?= old('username') ?>">
						<span class="form-error username">Username tidak boleh kosong</span>
						<label>Password</label>
						<input type="password" name="password" class="form-control" placeholder="password..." required>
						<span class="form-error password">Password tidak boleh kosong</span>
						<p></p>
						<button class="btn btn-danger btn-block"><i class="fa fa-sign-in"></i> Login</button>
					</form>
				</div>
			</div>
			<center>
				<a href="#">DMS HONDA</a>
			</center>
		</div>
	</div>
</div>
</body>
<script src="<?=$this->assets->get('js/site.js')?>"></script>
</html>