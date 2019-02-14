<?php
namespace app;
use vendor\zframework\Model;
use app\RelOperatorPos;

class Kategori extends Model
{
	static $table = "kategori";
	static $fields = ["id","nama"];
}
