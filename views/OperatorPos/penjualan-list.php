<?php $this->load("partial.header") ?>
<?php $this->load("partial.nav") ?>
<?php $this->load("partial.content-start") ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><i class="fas fa-motorcycle"></i> Penjualan Unit Sepeda Motor</h1>
</div>

<div>
	<table class="table table-bordered table-striped">
		<tr>
			<th>No</th>
			<th>Detail Unit</th>
			<th>No Mesin (Rangka)</th>
			<th>Status</th>
		</tr>
		<?php if(empty($unit)) : ?>
		<tr>
			<td colspan="4"><i>Tidak ada data!</i></td>
		</tr>
		<?php endif ?>
		<?php $no=1; $exists = 0; foreach ($unit as $value) { if(empty($value->penjualan())) continue; $exists++;?>
		<tr>
			<td><?= $no++ ?></td>
			<td>
				<b><?= $value->jenis()->nama ?></b> (<?= $value->jenis()->isi_silinder ?>cc)<br>
				<?= $value->jenis()->model ?> / <?= $value->jenis()->kategori()->nama ?> <br>
				<?= $value->warna ?>
			</td>
			<td>
				<?= $value->no_mesin ?><br>
				(<?= $value->nomor_rangka ?>)
			</td>
			<td>
				<i>Unit sudah terjual oleh <?= $value->penjualan()->sales()->nama ?></i>
			</td>
		</tr>
		<?php } ?>
		<?php if(!$exists) : ?>
		<tr>
			<td colspan="4"><i>Tidak ada data!</i></td>
		</tr>
		<?php endif ?>
	</table>
</div>
<?php $this->load("partial.content-end") ?>
<?php $this->load("partial.footer") ?>