<?php
namespace app;
use vendor\zframework\Model;
use app\Sales;
use app\Unit;
class Penjualan extends Model
{
	static $table = "penjualan";
	static $fields = ["id","unit_id","sales_id","created_at","updated_at"];

	function sales()
	{
		return $this->hasOne(Sales::class,["id"=>"sales_id"]);
	}

	function unit()
	{
		return $this->hasOne(Unit::class,["id"=>"unit_id"]);
	}
}
