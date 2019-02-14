<?php $this->load("partial.header") ?>
<?php $this->load("partial.nav") ?>
<?php $this->load("partial.content-start") ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><i class="fas fa-truck"></i> Mutasi</h1>
</div>

<div>
	<table class="table table-bordered table-striped">
		<tr>
			<th>No</th>
			<th>Detail Unit</th>
			<th>No Mesin (Rangka)</th>
			<th>Asal Pos</th>
			<th>Tujuan Pos</th>
		</tr>
		<?php if(empty($mutasi)) : ?>
		<tr>
			<td colspan="5"><i>Tidak ada data!</i></td>
		</tr>
		<?php endif ?>
		<?php $no=1; foreach ($mutasi as $value) { ?>
		<tr>
			<td><?= $no++ ?></td>
			<td>
				<b><?= $value->unit()->jenis()->nama ?></b> (<?= $value->unit()->jenis()->isi_silinder ?>cc)<br>
				<?= $value->unit()->jenis()->model ?> / <?= $value->unit()->jenis()->kategori()->nama ?> <br>
				<?= $value->unit()->warna ?>
			</td>
			<td>
				<?= $value->unit()->no_mesin ?><br>
				(<?= $value->unit()->nomor_rangka ?>)
			</td>
			<td>
				<?= $value->asal()->nama ?>
			</td>
			<td>
				<?= $value->tujuan()->nama ?>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>
<?php $this->load("partial.content-end") ?>
<?php $this->load("partial.footer") ?>