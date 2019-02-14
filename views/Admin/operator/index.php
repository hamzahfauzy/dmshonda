<?php $this->load("partial.header") ?>
<?php $this->load("partial.nav") ?>
<?php $this->load("partial.content-start") ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><i class="fas fa-user-tie"></i> Operator</h1>
	<a href="<?= base_url() ?>/admin/operator-list/add" class="btn btn-sm btn-outline-secondary">
		<i class="fa fa-plus"></i> Tambah Data
	</a>
</div>

<div>
	<table class="table table-bordered table-striped">
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Username</th>
			<th>Aksi</th>
		</tr>
		<?php if(empty($users)) : ?>
		<tr>
			<td colspan="4"><i>Tidak ada data!</i></td>
		</tr>
		<?php endif ?>
		<?php $no=1; foreach ($users as $user) { ?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $user->nama ?></td>
			<td><?= $user->username ?></td>
			<td>
				<a href="<?= base_url() ?>/admin/operator-list/edit/<?= $user->id ?>" class="btn btn-outline-success"><i class="fas fa-pencil-alt"></i> Edit</a>
				<a href="javascript:void(0)" class="btn btn-outline-primary" onclick="$('#form-delete-'+<?=$user->id?>).submit();"><i class="fas fa-trash"></i> Delete</a>
				<form id="form-delete-<?=$user->id?>" method="post" action="<?= base_url() ?>/admin/operator-list/delete">
					<input type="hidden" name="id" value="<?=$user->id?>">
				</form>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>
<?php $this->load("partial.content-end") ?>
<?php $this->load("partial.footer") ?>