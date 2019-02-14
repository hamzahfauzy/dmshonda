<?php $this->load("partial.header") ?>
<?php $this->load("partial.nav") ?>
<?php $this->load("partial.content-start") ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><i class="fas fa-dot-circle"></i> Target</h1>
	<a href="<?= base_url() ?>/admin/target-list" class="btn btn-sm btn-outline-secondary">
		<i class="fa fa-reply"></i> Kembali
	</a>
</div>

<div>
	<form method="post" action="<?= base_url()?>/admin/target-list/insert" style="width: 350px;">
		<?php if ($error) { ?>
		<div class="alert alert-danger" role="alert">
			Data target sudah ada.
		</div>						
		<?php } ?>
		<div class="form-group">
			<label for="bulan">Bulan</label>
			<select name="bulan" class="form-control" required="">
				<option value="">Pilih Bulan</option>
				<?php for($i=1;$i<13;$i++){ $bln = strlen($i) < 2 ? '0'.$i : $i; ?>
				<option value="<?= $bln ?>" <?= old('bulan') == $bln ? "selected=''" : "" ?>><?= date('F',strtotime('01.'.$i.'.2000')) ?></option>
				<?php } ?>
			</select>
			<span class="form-error bulan">Bulan tidak boleh kosong</span>
		</div>

		<div class="form-group">
			<label for="tahun">Tahun</label>
			<select name="tahun" class="form-control" required="">
				<option value="">Pilih Tahun</option>
				<?php for($i=date("Y");$i>=2010;$i--){ ?>
				<option value="<?= $i ?>" <?= old('tahun') == $i ? "selected=''" : "" ?>><?= $i ?></option>
				<?php } ?>
			</select>
			<span class="form-error tahun">Tahun tidak boleh kosong</span>
		</div>

		<div class="form-group">
			<label for="pos">Pos</label>
			<select name="pos" class="form-control" required="">
				<option value="">Pilih Pos</option>
				<?php foreach ($pos as $key => $value) { ?>
				<option value="<?= $value->id ?>" <?= old('pos') == $value->id ? 'selected=""' : '' ?>><?= $value->nama ?></option>
				<?php } ?>
			</select>
			<span class="form-error pos">Pos tidak boleh kosong</span>
		</div>

		<?php foreach ($kategori as $key => $value) { ?>
		<div class="form-group">
			<label for="jumlah-<?= $value->id ?>">Jumlah Target <?= $value->nama ?></label>
			<input type="tel" id="jumlah-<?= $value->id ?>" name="jumlah[<?= $value->id ?>]" placeholder="Jumlah target" required="" class="form-control">
		</div>
		<?php } ?>

		<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
	</form>
</div>
<?php $this->load("partial.content-end") ?>
<?php $this->load("partial.footer") ?>