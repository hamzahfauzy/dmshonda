<?php
namespace app;
use vendor\zframework\Model;
use app\RelOperatorPos;

class Pos extends Model
{
	static $table = "pos_dealer";
	static $fields = ["id","nama","alamat","created_at","updated_at"];

	function RelOperatorPos()
	{
		return $this->hasOne(RelOperatorPos::class, ['pos_id'=>'id']);
	}
}
