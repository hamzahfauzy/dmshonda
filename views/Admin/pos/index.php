<?php $this->load("partial.header") ?>
<?php $this->load("partial.nav") ?>
<?php $this->load("partial.content-start") ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><i class="fas fa-map-marker-alt"></i> Pos Dealer</h1>
	<a href="<?= base_url() ?>/admin/pos-list/add" class="btn btn-sm btn-outline-secondary">
		<i class="fa fa-plus"></i> Tambah Data
	</a>
</div>

<div>
	<table class="table table-bordered table-striped">
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Operator</th>
			<th>Aksi</th>
		</tr>
		<?php if(empty($pos)) : ?>
		<tr>
			<td colspan="4"><i>Tidak ada data!</i></td>
		</tr>
		<?php endif ?>
		<?php $no=1; foreach ($pos as $value) { ?>
		<tr>
			<td><?= $no++ ?></td>
			<td>
				<b><?= $value->nama ?></b><br>
				Alamat : <?= $value->alamat ?>
			</td>
			<td>
				<?php if(empty($value->RelOperatorPos())) : ?>
					<i>Belum ada operator</i><br>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#operator<?=$value->id?>">
					  Set Operator
					</button>
					<div class="modal" id="operator<?=$value->id?>">
					  <div class="modal-dialog">
					  	<form action="<?=base_url()?>/admin/pos-list/set-operator" method="post">
					  	<input type="hidden" name="pos_id" value="<?= $value->id?>">
					    <div class="modal-content">

					      <!-- Modal Header -->
					      <div class="modal-header">
					        <h4 class="modal-title">Set Operator</h4>
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					      </div>

					      <!-- Modal body -->
					      <div class="modal-body">
					        <div class="form-group">
					        	<label for="operator">Pilih Operator</label>
					        	<select id="operator" name="operator" class="form-control" required="">
					        		<?php if(empty($operator)): ?>
					        		<option value="">Tidak ada operator yang tersedia</option>
					        		<?php else: ?>
					        		<option value="">Pilih</option>
					        		<?php foreach ($operator as $op) { ?>
					        			<option value="<?=$op->id?>"><?=$op->nama?></option>
					        		<?php } ?>
					        		<?php endif ?>
					        	</select>
					        	<span class="form-error operator">Operator harus dipilih</span>
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
					<?= $value->RelOperatorPos()->operator()->nama ?><br>
					<a href="#" data-toggle="modal" data-target="#operator<?=$value->id?>">Edit</a> | <a href="javascript:void()" onclick="$('#form-operator-<?=$value->RelOperatorPos()->id?>').submit()" style="color: red">Hapus</a>
					<form method="post" action="<?= base_url()?>/admin/pos-list/hapus-operator" id="form-operator-<?=$value->RelOperatorPos()->id?>">
						<input type="hidden" name="id" value="<?=$value->RelOperatorPos()->id?>">
					</form>
					<div class="modal" id="operator<?=$value->id?>">
					  <div class="modal-dialog">
					  	<form action="<?=base_url()?>/admin/pos-list/edit-operator" method="post">
					  	<input type="hidden" name="pos_id" value="<?= $value->id?>">
					  	<input type="hidden" name="id" value="<?= $value->RelOperatorPos()->id?>">
					    <div class="modal-content">

					      <!-- Modal Header -->
					      <div class="modal-header">
					        <h4 class="modal-title">Edit Operator</h4>
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					      </div>

					      <!-- Modal body -->
					      <div class="modal-body">
					        <div class="form-group">
					        	<label for="operator">Pilih Operator</label>
					        	<select id="operator" name="operator" class="form-control" required="">
					        		<?php if(empty($operator)): ?>
					        		<option value="">Tidak ada operator yang tersedia</option>
					        		<?php else: ?>
					        		<option value="">Pilih</option>
					        		<?php foreach ($operator as $op) { ?>
					        			<option value="<?=$op->id?>"><?=$op->nama?></option>
					        		<?php } ?>
					        		<?php endif ?>
					        	</select>
					        	<span class="form-error operator">Operator harus dipilih</span>
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
				<a href="<?= base_url() ?>/admin/pos-list/edit/<?= $value->id ?>" class="btn btn-outline-success"><i class="fas fa-pencil-alt"></i> Edit</a>
				<a href="javascript:void(0)" class="btn btn-outline-primary" onclick="$('#form-delete-'+<?=$value->id?>).submit();"><i class="fas fa-trash"></i> Delete</a>
				<form id="form-delete-<?=$value->id?>" method="post" action="<?= base_url() ?>/admin/pos-list/delete">
					<input type="hidden" name="id" value="<?=$value->id?>">
				</form>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>
<?php $this->load("partial.content-end") ?>
<?php $this->load("partial.footer") ?>