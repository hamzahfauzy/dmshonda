<?php
namespace app;
use vendor\zframework\Model;
use app\Pos;
use app\Kategori;

class Target extends Model
{
	static $table = "target";
	static $fields = ["id","pos_id","kategori_id","jumlah","periode"];

	function pos()
	{
		return $this->hasOne(Pos::class,["id"=>"pos_id"]);
	}

	function kategori()
	{
		return $this->hasOne(Kategori::class, ["id"=>"kategori_id"]);
	}
}
