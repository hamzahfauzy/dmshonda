<table class="table table-bordered table-striped">
	<tr>
		<th style="width:10%">#</th>
		<th>Nama</th>
		<th style="width:10%">Jumlah</th>
	</tr>
	<?php $no=1;foreach ($sales as $key => $value) { if($no>5) break;?>
	<tr>
		<td><?=$no++?></td>
		<td><?=$value['nama']?></td>
		<td><?=$value['penjualan']?></td>
	</tr>
	<?php } ?>
</table>