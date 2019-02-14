<?php
namespace app;
use vendor\zframework\Model;
use app\Kategori;
use app\Unit;

class Jenis extends Model
{
	static $table = "jenis_sm";
	static $fields = ["id","kategori_id","nama","model","tahun_pembuatan","isi_silinder","created_at","updated_at"];

	function kategori()
	{
		return $this->hasOne(Kategori::class, ["id"=>"kategori_id"]);
	}

	function jumlahStok($pos_id)
	{
		$model = Unit::where("jenis_id",$this->id)->where("pos_id",$pos_id)->get();
		return count($model);
	}
}
