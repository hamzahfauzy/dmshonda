<?php use vendor\zframework\Session; ?>
<?php $this->load("partial.header") ?>
<?php $this->load("partial.nav") ?>
<?php $this->load("partial.content-start") ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><i class="fa fa-users"></i> Sales <?= Session::user()->RelOperatorPos()->pos()->nama ?></h1>
</div>
<div class="content">
	<table class="table table-bordered table-striped">
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>No Telepon</th>
			<th>Detail</th>
		</tr>
		<?php if(empty($sales)) : ?>
		<tr>
			<td colspan="5"><i>Tidak ada data!</i></td>
		</tr>
		<?php endif ?>
		<?php $no=1; foreach ($sales as $key => $value): ?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $value->sales()->nama ?></td>
			<td><?= $value->sales()->alamat ?></td>
			<td><?= $value->sales()->telepon ?></td>
			<td>
				Detail
			</td>
		</tr>
		<?php endforeach ?>
	</table>
</div>
<?php $this->load("partial.content-end") ?>
<?php $this->load("partial.footer") ?>