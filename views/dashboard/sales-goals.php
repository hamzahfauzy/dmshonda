<table class="table table-bordered table-striped" style="width: 100%;">
	<tr>
		<th style="width:5%">#</th>
		<th style="width:50%">Nama</th>
		<th style="width:5%">Jumlah</th>
	</tr>
	<?php $no=1;foreach ($sales as $key => $value) {?>
	<tr>
		<td><?=$no++?></td>
		<td><?=$value['nama']?></td>
		<td><?=$value['penjualan']?></td>
	</tr>
	<?php } ?>
</table>