<?php
namespace app\controllers\Admin;
use vendor\zframework\Controller;
use vendor\zframework\Session;
use vendor\zframework\util\Request;
use app\User;
use app\Mutasi;
use app\Unit;

class IndexController extends Controller
{
	function __construct()
	{
		parent::__construct();
		// echo password_hash("admin", PASSWORD_DEFAULT);
	}

	function index()
	{
		return $this->view->render("Admin.index");
	}

	function mutasi()
	{
		$mutasi = Mutasi::get();
		$data["mutasi"] = $mutasi;
		return $this->view->render("Admin.mutasi")->with($data);
	}

	function penjualan()
	{
		$unit = Unit::get();
		$data["unit"] = $unit;
		return $this->view->render("Admin.penjualan-list")->with($data);
	}

}
