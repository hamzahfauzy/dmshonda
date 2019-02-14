<?php
namespace app\controllers;
use vendor\zframework\Controller;
use vendor\zframework\Session;
use vendor\zframework\util\Request;
use app\User;
use app\Sales;
use app\Kategori;
use app\Target;
use app\Penjualan;
use app\Stok;

class IndexController extends Controller
{
	function __construct()
	{
		parent::__construct();
		// echo password_hash("admin", PASSWORD_DEFAULT);
	}

	function setting()
	{
		$this->view->render("dashboard.setting");
	}

	function updatesetting(Request $request)
	{
		$user = User::where("id",Session::get("id"))->first();
		$user->nama = $request->nama;
		if(!empty($request->password))
		{
			$user->password = password_hash($request->password, PASSWORD_DEFAULT);
		}
		$user->save();
		$this->redirect()->url("/akun/setting");
	}

	function login()
	{
		$error = isset($_GET['error']) ? $_GET['error'] : false;
		return $this->view->render("login")->with("error",$error);
	}

	function doLogin(Request $req)
	{
		$user = User::where("username",$req->username)->first();
		if(!empty($user))
		{
			$check_password = password_verify ($req->password, $user->password);
			if($check_password)
			{
				Session::set("id",$user->id);
				$this->redirect()->url("/");
				return;
			}else{
				$this->redirect()->url("/login?error=password");
				return;
			}
		}else{
			$this->redirect()->url("/login?error=username");
			return;
		}
	}

	function logout()
	{
		Session::destroy();
		$this->redirect()->url("/");
	}

	function index()
	{
		$sales = Sales::get();
		$sales_data = [];
		foreach ($sales as $key => $value) {
			$sales_data[] = ["nama"=>$value->nama,"penjualan"=>count($value->penjualan())];
		}

		usort($sales_data, function($a, $b) {
		    return $b['penjualan'] - $a['penjualan'];
		});

		$data["sales"] = $sales_data;
		return $this->view->render("index")->with($data);
	}

	function top5sales()
	{
		$sales = Sales::get();
		$sales_data = [];
		foreach ($sales as $key => $value) {
			$sales_data[] = ["nama"=>$value->nama,"penjualan"=>count($value->penjualan())];
		}

		usort($sales_data, function($a, $b) {
		    return $b['penjualan'] - $a['penjualan'];
		});

		$data["sales"] = $sales_data;
		return $this->view->render("dashboard.top5sales")->with($data);
	}

	function salesgoals()
	{
		$sales = Sales::get();
		$sales_data = [];
		foreach ($sales as $key => $value) {
			$sales_data[] = ["nama"=>$value->nama,"penjualan"=>count($value->penjualan())];
		}

		usort($sales_data, function($a, $b) {
		    return $b['penjualan'] - $a['penjualan'];
		});

		$data["sales"] = $sales_data;
		return $this->view->render("dashboard.sales-goals")->with($data);
	}

	function targetsales()
	{
		$kategori = Kategori::get();
		$cat = [];
		foreach ($kategori as $key => $value) {
			$cat[$value->id]["penjualan"] = 0;
			$cat[$value->id]["target"] = 0;
			$cat[$value->id]["nama"] = $value->nama;
		}


		$periode = date("m-Y");
		$penjualan = Penjualan::get();
		$target = Target::where("periode",$periode)->get();
		foreach ($target as $key => $value) {
			$cat[$value->kategori_id]["target"] += $value->jumlah;
		}

		foreach ($penjualan as $key => $value) {
			$cat[$value->unit()->jenis()->kategori()->id]["penjualan"]++;
		}

		$data["kategori"] = $cat;

		echo json_encode($data);
	}

	function stok()
	{
		$kategori = Kategori::get();
		$cat = [];
		foreach ($kategori as $key => $value) {
			$cat[$value->id]["nama"] = $value->nama;
			$cat[$value->id]["stok"] = 0;
		}	

		$stok = Stok::get();
		foreach ($stok as $key => $value) {
			$cat[$value->jenis()->kategori()->id]["stok"] += $value->jumlah;
		}

		$data["stok"] = $cat;
		echo json_encode($data);
	}

}
