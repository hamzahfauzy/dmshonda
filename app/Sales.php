<?php
namespace app;
use vendor\zframework\Model;
use app\RelSalesPos;
use app\Penjualan;

class Sales extends Model
{
	static $table = "sales";
	static $fields = ["id","NIK","nama","alamat","telepon","jenis_kelamin","created_at","updated_at"];

	function RelSalesPos()
	{
		return $this->hasOne(RelSalesPos::class,["sales_id"=>"id"]);
	}

	function penjualan()
	{
		return $this->hasMany(Penjualan::class,["sales_id"=>"id"]);
	}

}
