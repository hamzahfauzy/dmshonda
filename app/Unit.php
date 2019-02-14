<?php
namespace app;
use vendor\zframework\Model;
use app\Jenis;
use app\Pos;
use app\Penjualan;

class Unit extends Model
{
	static $table = "unit_sm";
	static $fields = ["id","jenis_id","pos_id","no_mesin","warna","nomor_rangka","created_at","updated_at"];

	function jenis()
	{
		return $this->hasOne(Jenis::class, ["id"=>"jenis_id"]);
	}

	function pos()
	{
		return $this->hasOne(Pos::class, ["id"=>"pos_id"]);
	}

	function penjualan()
	{
		return $this->hasOne(Penjualan::class,["unit_id"=>"id"]);
	}
}
