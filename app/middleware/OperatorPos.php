<?php
namespace app\middleware;
use vendor\zframework\Middleware;
use vendor\zframework\Session;

class OperatorPos extends Middleware
{
	
	function __construct()
	{
		$condition = isset(Session::user()->id) && Session::user()->level == 2;
		$redirect = "/";
		parent::__construct($condition,$redirect);
	}
}
