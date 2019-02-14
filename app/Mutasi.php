<?php
namespace app;
use vendor\zframework\Model;
use app\Pos;
use app\Unit;

class Mutasi extends Model
{
	static $table = "mutasi";
	static $fields = ["id","unit_id","asal_pos_id","tujuan_pos_id","created_at","tanggal_mutasi"];

	function unit()
	{
		return $this->hasOne(Unit::class, ["id"=>"unit_id"]);
	}

	function asal()
	{
		return $this->hasOne(Pos::class, ["id"=>"asal_pos_id"]);
	}

	function tujuan()
	{
		return $this->hasOne(Pos::class, ["id"=>"tujuan_pos_id"]);
	}
}
