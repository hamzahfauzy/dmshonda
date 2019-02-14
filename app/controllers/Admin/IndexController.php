<?php
namespace app\controllers\Admin;
use vendor\zframework\Controller;
use vendor\zframework\Session;
use vendor\zframework\util\Request;
use app\User;
use app\Mutasi;
use app\Unit;
use app\Target;
use app\Kategori;

class IndexController extends Controller
{
	function __construct()
	{
		parent::__construct();
		// echo password_hash("admin", PASSWORD_DEFAULT);
	}

	function index()
	{
		$kategori = Kategori::get();
		$cat = [];
		$pj = [];
		foreach ($kategori as $key => $value) {
			$cat[$value->id]["nama"] = $value->nama;
			$cat[$value->id]["target"] = 0; 

			$pj[$value->id]["nama"] = $value->nama;
			$pj[$value->id]["penjualan"] = 0; 
		}
		$periode = date("m-Y");
		$target = Target::where("periode",$periode)->get();
		foreach ($target as $key => $value) {
			$cat[$value->kategori()->id]["target"] += $value->jumlah;
		}

		$unit = Unit::get();
		foreach ($unit as $key => $value) {
			if(!empty($value->penjualan()))
			{
				$pj[$value->jenis()->kategori()->id]["penjualan"]++;
			}
		}
		$data["target"] = $cat;
		$data["penjualan"] = $pj;
		return $this->view->render("Admin.index")->with($data);
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
