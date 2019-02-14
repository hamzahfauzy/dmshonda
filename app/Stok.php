<?php
namespace app;
use vendor\zframework\Model;
use app\Jenis;
use app\Pos;

class Stok extends Model
{
	static $table = "stok_sm";
	static $fields = ["id","jenis_sm_id","pos_id","jumlah","created_at","updated_at"];

	function jenis()
	{
		return $this->hasOne(Jenis::class, ["id"=>"jenis_sm_id"]);
	}

	function pos()
	{
		return $this->hasOne(Pos::class, ["id"=>"pos_id"]);	
	}
}
