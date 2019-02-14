<?php $this->load("partial.header") ?>
<?php $this->load("partial.nav") ?>
<?php $this->load("partial.content-start") ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><i class="fas fa-motorcycle"></i> Unit Sepeda Motor</h1>
	<a href="<?= base_url() ?>/admin/unit-list/add" class="btn btn-sm btn-outline-secondary">
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
			<input type="text" name="keyword" placeholder="Kata kunci" class="form-control" required="" value="<?= isset($_GET['action']) && $_GET['action'] == "search" ? $_GET['keyword'] : ''; ?>">&nbsp;
			<select name="filterby" class="form-control" required="">
				<option value="">Cari berdasarkan</option>
				<option value="warna" <?= isset($_GET['action']) && $_GET['action'] == "search" && $_GET['filterby'] == "warna" ? "selected=''" : ''; ?>>Warna</option>
				<option value="no_mesin" <?= isset($_GET['action']) && $_GET['action'] == "search" && $_GET['filterby'] == "no_mesin" ? "selected=''" : ''; ?>>Nomor Mesin</option>
				<option value="nomor_rangka" <?= isset($_GET['action']) && $_GET['action'] == "search" && $_GET['filterby'] == "nomor_rangka" ? "selected=''" : ''; ?>>Nomor Rangka</option>
			</select>&nbsp;
			<button class="btn btn-outline-primary">Filter</button>
			</div>
		</div>
	</div>
	</form>
	<table class="table table-bordered table-striped">
		<tr>
			<th>No</th>
			<th>Detail Unit</th>
			<th>No Mesin (Rangka)</th>
			<th>Pos</th>
			<th>Aksi</th>
		</tr>
		<?php if(empty($unit)) : ?>
		<tr>
			<td colspan="5"><i>Tidak ada data!</i></td>
		</tr>
		<?php endif ?>
		<?php $no=1; foreach ($unit as $value) { ?>
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
				<?php if($value->pos_id == NULL): ?>
					<i>Unit masih didalam gudang.</i><br>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pos<?=$value->id?>">
					  Kirim ke Pos
					</button>
					<div class="modal" id="pos<?=$value->id?>">
					  <div class="modal-dialog">
					  	<form action="<?=base_url()?>/admin/unit-list/set-pos" method="post">
					  	<input type="hidden" name="id" value="<?= $value->id?>">
					    <div class="modal-content">

					      <!-- Modal Header -->
					      <div class="modal-header">
					        <h4 class="modal-title">Kirim unit ke Pos</h4>
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					      </div>

					      <!-- Modal body -->
					      <div class="modal-body">
					        <div class="form-group">
					        	<label for="pos">Pilih Pos</label>
					        	<select id="pos" name="pos_id" class="form-control" required="">
					        		<option value="">Pilih</option>
					        		<?php foreach ($pos as $op) { ?>
					        		<option value="<?=$op->id?>"><?=$op->nama?></option>
					        		<?php } ?>
					        	</select>
					        	<span class="form-error pos_id">Pos harus dipilih</span>
					        </div>
					      </div>

					      <!-- Modal footer -->
					      <div class="modal-footer">
					      	<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
					        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					      </div>

					    </div>
						</form>
					  </div>
					</div>
				<?php else: ?>
					<?= $value->pos()->nama ?><br>
					<?php if(empty($value->penjualan())) : ?>
					<a href="#" data-toggle="modal" data-target="#pos<?=$value->id?>">Mutasi</a> | <a href="javascript:void()" onclick="$('#form-pos-<?=$value->id?>').submit()" style="color: red">Hapus</a>
					<form method="post" action="<?= base_url()?>/admin/unit-list/hapus-pos" id="form-pos-<?=$value->id?>">
						<input type="hidden" name="id" value="<?=$value->id?>">
					</form>
					<div class="modal" id="pos<?=$value->id?>">
					  <div class="modal-dialog">
					  	<form action="<?=base_url()?>/admin/unit-list/edit-pos" method="post">
					  	<input type="hidden" name="id" value="<?= $value->id?>">
					    <div class="modal-content">

					      <!-- Modal Header -->
					      <div class="modal-header">
					        <h4 class="modal-title">Edit Pos</h4>
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					      </div>

					      <!-- Modal body -->
					      <div class="modal-body">
					        <div class="form-group">
					        	<label for="pos">Pilih Pos</label>
					        	<select id="pos" name="pos_id" class="form-control" required="">
					        		<option value="">Pilih</option>
					        		<?php foreach ($pos as $op) { ?>
					        		<option value="<?=$op->id?>" <?= $value->pos_id == $op->id ? "selected=''" : "" ?>><?=$op->nama?></option>
					        		<?php } ?>
					        	</select>
					        	<span class="form-error pos_id">Pos harus dipilih</span>
					        </div>
					      </div>

					      <!-- Modal footer -->
					      <div class="modal-footer">
					      	<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
					        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					      </div>

					    </div>
						</form>
					  </div>
					</div>
					<?php else: ?>
					<i>Unit sudah terjual</i>
					<?php endif ?>
				<?php endif ?>
			</td>
			<td>
				<a href="<?= base_url() ?>/admin/unit-list/edit/<?= $value->id ?>" class="btn btn-outline-success"><i class="fas fa-pencil-alt"></i> Edit</a>
				<a href="javascript:void(0)" class="btn btn-outline-primary" onclick="$('#form-delete-'+<?=$value->id?>).submit();"><i class="fas fa-trash"></i> Delete</a>
				<form id="form-delete-<?=$value->id?>" method="post" action="<?= base_url() ?>/admin/unit-list/delete">
					<input type="hidden" name="id" value="<?=$value->id?>">
				</form>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>
<?php $this->load("partial.content-end") ?>
<?php $this->load("partial.footer") ?>