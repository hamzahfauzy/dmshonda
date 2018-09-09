<?php
namespace vendor\zframework;

class Route
{
	public static $_get = [];
	public static $_post = [];
	public static $base_prefix;
	public static $_namespace;
	public static $_middleware = "";

	public static function prefix($base_prefix)
	{
		self::$base_prefix = $base_prefix;
		return new static;
	}

	public static function namespace($name)
	{
		self::$_namespace = $name."\\";
		return new static;
	}

	public static function middleware($name)
	{
		self::$_middleware = $name;
		return new static;
	}

	public static function group($callback)
	{
		return call_user_func($callback);
	}

	public static function get($url,$controller,$param=false)
	{

		if(!empty(self::$base_prefix))
			$url = self::$base_prefix . $url;
		if($url != "/") $url = rtrim($url,"/");
		$key = count(self::$_get);
		self::$_get[$key]["url"] = $url;
		self::$_get[$key]["controller"] = self::$_namespace.$controller;
		self::$_get[$key]["param"] = $param;
		self::$_get[$key]["middleware"] = self::$_middleware;
	}

	public static function post($url,$controller)
	{
		if(!empty(self::$base_prefix))
			$url = self::$base_prefix . $url;
		if($url != "/") $url = rtrim($url,"/");
		$key = count(self::$_post);
		self::$_post[$key]["url"] = $url;
		self::$_post[$key]["controller"] = $controller;
		self::$_post[$key]["middleware"] = self::$_middleware;
	}

	public static function fetchGet($uri)
	{
		$return = new \stdClass();
		foreach (self::$_get as $key => $value) {
			if($value['url'] == $uri){
				$arr = explode("@", $value["controller"]);
				$arr[0] = "app\\controllers\\".$arr[0];
				$return->className = $arr[0];
				$return->method = $arr[1];
				$return->middleware = $value["middleware"];
				if($value["param"])
					$return->param = $value["param"];
				break;
			}
		}
		return $return;
	}

	public static function fetchPost($uri)
	{
		$return = new \stdClass();
		foreach (self::$_post as $key => $value) {
			if($value['url'] == $uri){
				$arr = explode("@", $value["controller"]);
				$arr[0] = "app\\controllers\\".$arr[0];
				$return->className = $arr[0];
				$return->method = $arr[1];
				$return->middleware = $value["middleware"];
				break;
			}
		}
		return $return;
	}
}