<?php
namespace app\controllers\OperatorPos;
use vendor\zframework\Controller;
use vendor\zframework\Session;
use vendor\zframework\util\Request;
use app\User;
use app\Sales;
use app\Jenis;
use app\RelSalesPos;
use app\Unit;
use app\Penjualan;
use app\Stok;
use app\Kategori;
use app\Target;

class IndexController extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->pos = Session::user()->RelOperatorPos()->pos();
		// echo password_hash("admin", PASSWORD_DEFAULT);
	}

	function index()
	{
		$periode = date("m-Y");
		$target = Target::where("pos_id",$this->pos->id)->where("periode",$periode)->get();
		$data["target"] = $target;

		$unit = Unit::where("pos_id",$this->pos->id)->get();
		$cat = [];
		$kategori = Kategori::get();
		foreach ($kategori as $key => $value) {
			$cat[$value->id]["nama"] = $value->nama;
			$cat[$value->id]["penjualan"] = 0;
		}

		foreach ($unit as $key => $value) {
			if(!empty($value->penjualan()))
			{
				$cat[$value->jenis()->kategori()->id]["penjualan"]++;
			}
		}

		$data["penjualan"] = $cat;
		return $this->view->render("OperatorPos.index")->with($data);
	}

	function stok()
	{
		$jenis = Jenis::get();
		$stok = Stok::where("pos_id",$this->pos->id)->get();
		$data["stok"] = $stok;
		return $this->view->render("OperatorPos.stok-list")->with($data);
	}

	function sales()
	{
		$rel_sales = RelSalesPos::where("pos_id",$this->pos->id)->get();
		return $this->view->render("OperatorPos.sales-list")->with("sales",$rel_sales);
	}

	function unit()
	{
		$unit = Unit::where("pos_id",$this->pos->id)->get();
		$rel_sales = RelSalesPos::where("pos_id",$this->pos->id)->get();
		$data["unit"] = $unit;
		$data["rel_sales"] = $rel_sales;
		return $this->view->render("OperatorPos.unit-list")->with($data);
	}

	function setpenjualan(Request $request)
	{
		$model = new Penjualan;
		$model->sales_id = $request->sales_id;
		$model->unit_id = $request->id;
		$model->created_at = date("Y-m-d H:i:s");
		$model->updated_at = date("Y-m-d H:i:s");
		$model->save();

		$unit = Unit::where("id",$request->id)->first();
		$stok = Stok::where("jenis_sm_id",$unit->jenis()->id)->where("pos_id",$this->pos->id)->first();
		$stok->jumlah = $stok->jumlah-1;
		$stok->save();

		$this->redirect()->url("/operator/unit-list");
		return;
	}

	function penjualan()
	{
		$unit = Unit::where("pos_id",$this->pos->id)->get();
		$rel_sales = RelSalesPos::where("pos_id",$this->pos->id)->get();
		$data["unit"] = $unit;
		$data["rel_sales"] = $rel_sales;
		return $this->view->render("OperatorPos.penjualan-list")->with($data);
	}

}
