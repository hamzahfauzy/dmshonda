<?php $this->load("partial.header") ?>
<?php $this->load("partial.nav") ?>
<?php $this->load("partial.content-start") ?>
<?php 
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
$periode = isset($_GET['filterby']) ? $_GET['bulan']."-".$_GET['tahun'] : date("m-Y");
$periode = date("F Y",strtotime("01-".$periode." 00:00:00"));
$where_periode = date("m-Y",strtotime("01-".$periode." 00:00:00"));

?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><i class="fas fa-dot-circle"></i> Target Penjualan <?= $periode ?></h1>
	<a href="<?= base_url() ?>/admin/target-list/add" class="btn btn-sm btn-outline-secondary">
		<i class="fa fa-plus"></i> Tambah Data
	</a>
</div>

<div>
	<form>
	<input type="hidden" name="action" value="search">
	<div class="row">
		<div class="col">
			<div class="form-group form-inline">
			<label><b>Filter :</b> &nbsp;</label>
			<input type="hidden" name="filterby" value="periode">
			<select name="bulan" class="form-control" required="">
				<option value="">Pilih Bulan</option>
				<?php for($i=1;$i<13;$i++){ ?>
				<option value="<?= $i ?>" <?= $bulan == $i ? "selected=''" : "" ?>><?= date('F',strtotime('01.'.$i.'.2000')) ?></option>
				<?php } ?>
			</select>&nbsp;
			<select name="tahun" class="form-control" required="">
				<option value="">Pilih Tahun</option>
				<?php for($i=date("Y");$i>=2010;$i--){ ?>
				<option value="<?= $i ?>" <?= $tahun == $i ? "selected=''" : "" ?>><?= $i ?></option>
				<?php } ?>
			</select>&nbsp;
			<button class="btn btn-outline-primary">Filter</button>
			</div>
		</div>
	</div>
	</form>

	<table class="table table-bordered table-striped">
		<tr>
			<th>No</th>
			<th>Nama POS</th>
			<?php foreach ($kategori as $key => $value) { ?>
			<th><?= $value->nama ?></th>
			<?php } ?>
			<th>Aksi</th>
		</tr>
		<?php if(empty($target)): ?>
		<tr>
			<td colspan="<?= count($kategori)+3 ?>">
				<i>Tidak ada data!</i>
			</td>
		</tr>
		<?php endif ?>
		<?php $no=1; foreach ($target as $key => $value) { ?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $value['nama'] ?></td>
			<?php foreach ($kategori as $val) { ?>
			<td><?= $value[$val->id] ?></td>
			<?php } ?>
			<td>
				<a href="<?= base_url() ?>/admin/target-list/edit/<?=$where_periode?>/<?=$key?>" class="btn btn-outline-success"><i class="fas fa-pencil-alt"></i> Edit</a>
				<a href="javascript:void(0)" class="btn btn-outline-primary" onclick="$('#form-delete-'+<?=$key?>).submit();"><i class="fas fa-trash"></i> Delete</a>
				<form id="form-delete-<?=$key?>" method="post" action="<?= base_url() ?>/admin/target-list/delete">
					<input type="hidden" name="periode" value="<?=$where_periode?>">
					<input type="hidden" name="pos_id" value="<?=$key?>">
				</form>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>
<?php $this->load("partial.content-end") ?>
<?php $this->load("partial.footer") ?>