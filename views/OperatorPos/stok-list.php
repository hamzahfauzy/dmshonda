<?php 
use vendor\zframework\Session; 
$pos_id = Session::user()->RelOperatorPos()->pos()->id;
?>
<?php $this->load("partial.header") ?>
<?php $this->load("partial.nav") ?>
<?php $this->load("partial.content-start") ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><i class="fa fa-list-alt"></i> Stok <?= Session::user()->RelOperatorPos()->pos()->nama ?></h1>
</div>
<div class="content">
	<table class="table table-bordered table-striped">
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Jumlah</th>
			<!-- <th>Lihat</th> -->
		</tr>
		<?php if(empty($stok)) : ?>
		<tr>
			<td colspan="3"><i>Tidak ada data!</i></td>
		</tr>
		<?php endif ?>
		<?php $no=1; foreach ($stok as $key => $value): ?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $value->jenis()->nama ?></td>
			<td><?= $value->jumlah ?></td>
			<!-- <td></td> -->
		</tr>
		<?php endforeach ?>
	</table>
</div>
<?php $this->load("partial.content-end") ?>
<?php $this->load("partial.footer") ?>