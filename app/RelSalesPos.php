<?php
namespace app;
use vendor\zframework\Model;
use app\Sales;
use app\Pos;

class RelSalesPos extends Model
{
	static $table = "rel_sales_pos";
	static $fields = ["id","sales_id","pos_id"];

	function sales()
	{
		return $this->hasOne(Sales::class, ['id'=>'sales_id']);
	}

	function pos()
	{
		return $this->hasOne(Pos::class, ['id'=>'pos_id']);
	}
}
