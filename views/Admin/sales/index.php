<?php $this->load("partial.header") ?>
<?php $this->load("partial.nav") ?>
<?php $this->load("partial.content-start") ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><i class="fas fa-users"></i> Sales</h1>
	<a href="<?= base_url() ?>/admin/sales-list/add" class="btn btn-sm btn-outline-secondary">
		<i class="fa fa-plus"></i> Tambah Data
	</a>
</div>

<div>
	<table class="table table-bordered table-striped">
		<tr>
			<th>No</th>
			<th>NIK</th>
			<th>Detail</th>
			<th>Pos Penugasan</th>
			<th>Aksi</th>
		</tr>
		<?php if(empty($sales)) : ?>
		<tr>
			<td colspan="4"><i>Tidak ada data!</i></td>
		</tr>
		<?php endif ?>
		<?php $no=1; foreach ($sales as $value) { ?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $value->NIK ?></td>
			<td>
				<b><?= $value->nama ?></b><br>
				<?= $value->alamat ?><br>
				<?= $value->jenis_kelamin ?>
			</td>
			<td>
				<?php if(empty($value->RelSalesPos())) : ?>
					<i>Belum ada penugasan</i><br>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#operator<?=$value->id?>">
					  Set Pos
					</button>
					<div class="modal" id="operator<?=$value->id?>">
					  <div class="modal-dialog">
					  	<form action="<?=base_url()?>/admin/sales-list/set-pos" method="post">
					  	<input type="hidden" name="sales_id" value="<?= $value->id?>">
					    <div class="modal-content">

					      <!-- Modal Header -->
					      <div class="modal-header">
					        <h4 class="modal-title">Set Pos Penugasan</h4>
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
					<?= $value->RelSalesPos()->pos()->nama ?><br>
					<a href="#" data-toggle="modal" data-target="#operator<?=$value->id?>">Edit</a> | <a href="javascript:void()" onclick="$('#form-operator-<?=$value->RelSalesPos()->id?>').submit()" style="color: red">Hapus</a>
					<form method="post" action="<?= base_url()?>/admin/sales-list/hapus-pos" id="form-operator-<?=$value->RelSalesPos()->id?>">
						<input type="hidden" name="id" value="<?=$value->RelSalesPos()->id?>">
					</form>
					<div class="modal" id="operator<?=$value->id?>">
					  <div class="modal-dialog">
					  	<form action="<?=base_url()?>/admin/sales-list/edit-pos" method="post">
					  	<input type="hidden" name="sales_id" value="<?= $value->id?>">
					  	<input type="hidden" name="id" value="<?= $value->RelSalesPos()->id?>">
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
					        		<option value="<?=$op->id?>" <?= $value->RelSalesPos()->pos_id == $op->id ? "selected=''" : "" ?>><?=$op->nama?></option>
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
				<?php endif ?>
			</td>
			<td>
				<a href="<?= base_url() ?>/admin/sales-list/edit/<?= $value->id ?>" class="btn btn-outline-success"><i class="fas fa-pencil-alt"></i> Edit</a>
				<a href="javascript:void(0)" class="btn btn-outline-primary" onclick="$('#form-delete-'+<?=$value->id?>).submit();"><i class="fas fa-trash"></i> Delete</a>
				<form id="form-delete-<?=$value->id?>" method="post" action="<?= base_url() ?>/admin/sales-list/delete">
					<input type="hidden" name="id" value="<?=$value->id?>">
				</form>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>
<?php $this->load("partial.content-end") ?>
<?php $this->load("partial.footer") ?>