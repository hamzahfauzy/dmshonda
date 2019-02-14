<?php
namespace app;
use vendor\zframework\Model;
use app\User;
use app\Pos;

class RelOperatorPos extends Model
{
	static $table = "rel_operator_pos";
	static $fields = ["id","operator_id","pos_id"];

	function operator()
	{
		return $this->hasOne(User::class, ['id'=>'operator_id']);
	}

	function pos()
	{
		return $this->hasOne(Pos::class, ['id'=>'pos_id']);
	}
}
