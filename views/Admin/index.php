<?php $this->load("partial.header") ?>
<?php $this->load("partial.nav") ?>
<?php $this->load("partial.content-start") ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2">Dashboard</h1>
</div>
<div class="content">
	<div class="row">
		<div class="col-sm-6">
			<h2>Target Bulan <?= date("F Y") ?></h2>
			<table class="table table-bordered">
				<tr>
					<th>No</th>
					<th>Kategori</th>
					<th>Jumlah</th>
				</tr>
				<?php if(empty($target)) : ?>
				<tr>
					<td colspan="3"><i>Tidak ada data!</i></td>
				</tr>
				<?php endif ?>
				<?php $no=1; foreach ($target as $key => $value) { ?>
				<tr>
					<td><?=$no++?></td>
					<td><?=$value['nama'] ?></td>
					<td><?=$value['target']?></td>
				</tr>
				<?php } ?>
			</table>
		</div>
		<div class="col-sm-6">
			<h2>Pencapaian Bulan <?= date("F Y") ?></h2>
			<table class="table table-bordered">
				<tr>
					<th>No</th>
					<th>Kategori</th>
					<th>Jumlah</th>
				</tr>
				<?php if(empty($penjualan)) : ?>
				<tr>
					<td colspan="3"><i>Tidak ada data!</i></td>
				</tr>
				<?php endif ?>
				<?php $no=1; foreach ($penjualan as $key => $value) { ?>
				<tr>
					<td><?=$no++?></td>
					<td><?=$value['nama'] ?></td>
					<td><?=$value['penjualan']?></td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</div>
<?php $this->load("partial.content-end") ?>
<?php $this->load("partial.footer") ?>