<?php
namespace app;
use vendor\zframework\Model;
use app\RelOperatorPos;

class User extends Model
{
	static $table = "users";
	static $fields = ["id","nama","username","password","level"];

	function RelOperatorPos()
	{
		return $this->hasOne(RelOperatorPos::class, ['operator_id'=>'id']);
	}
}
