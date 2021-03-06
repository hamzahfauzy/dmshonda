<?php
namespace app\middleware;
use vendor\zframework\Middleware;
use vendor\zframework\Session;

class Login extends Middleware
{
	
	function __construct()
	{
		$condition = !isset(Session::user()->id);
		$redirect = "/";
		parent::__construct($condition,$redirect);
	}
}
