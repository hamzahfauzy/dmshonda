<?php
namespace app\controllers\Admin;
use vendor\zframework\Controller;
use vendor\zframework\Session;
use vendor\zframework\util\Request;
use app\Pos;
use app\Target;
use app\Kategori;

class TargetController extends Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$kategori = Kategori::get();
		$pos = Pos::get();
		$data["kategori"] = $kategori;
		$data["pos"] = $pos;

		$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
		$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
		$periode = isset($_GET['filterby']) ? (strlen($bulan) < 2 ? '0'.$bulan : $bulan)."-".$tahun : date("m-Y");
		$periode = date("F Y",strtotime("01-".$periode." 00:00:00"));
		$where_periode = date("m-Y",strtotime("01-".$periode." 00:00:00"));
		$target = Target::where("periode",$where_periode)->get();
		
		$old_pos_id = 0;
		$trgt = [];
		foreach ($target as $key => $value) {
			$pos_id = $value->pos_id != $old_pos_id ? $value->pos_id : $old_pos_id;
			if(!isset($trgt[$pos_id]["nama"]))
				$trgt[$pos_id]["nama"] = $value->pos()->nama;
			$trgt[$pos_id][$value->kategori_id] = $value->jumlah;
		}
		$data['target'] = $trgt;
		return $this->view->render("Admin.target.index")->with($data);
	}

	function add()
	{
		$data["error"] = isset($_GET['error']) ? $_GET['error'] : false;
		$kategori = Kategori::get();
		$pos = Pos::get();
		$data["kategori"] = $kategori;
		$data["pos"] = $pos;
		return $this->view->render("Admin.target.add-form")->with($data);
	}

	function edit($periode,$id)
	{
		$target = Target::where("periode",$periode)->where("pos_id",$id)->get();
		$error = isset($_GET['error']) ? $_GET['error'] : false;
		
		$old_pos_id = 0;
		$trgt = [];
		foreach ($target as $key => $value) {
			$pos_id = $value->pos_id != $old_pos_id ? $value->pos_id : $old_pos_id;
			if(!isset($trgt["pos_id"]))
				$trgt["pos_id"] = $value->pos_id;
			$trgt["id"][] = $value->id;
			$trgt[$value->kategori_id] = $value->jumlah;
		}
		$data['target'] = $trgt;

		$data["error"] = $error;
		$kategori = Kategori::get();
		$pos = Pos::get();
		$data["kategori"] = $kategori;
		$data["pos"] = $pos;
		$data["periode"] = $periode;
		return $this->view->render("Admin.target.edit-form")->with($data);
	}

	function insert(Request $request)
	{
		// check user exists
		$periode = $request->bulan."-".$request->tahun;
		$pos_id = $request->pos;
		$model = Target::where("periode",$periode)->where("pos_id",$pos_id)->first();
		if(!empty($model))
		{
			$this->redirect()->url("/admin/target-list/add?error=exists");
			return;
		}

		foreach($request->jumlah as $key => $value){
			$target = new Target;
			$target->periode = $periode;
			$target->jumlah = $value;
			$target->pos_id = $request->pos;
			$target->kategori_id = $key;
			$target->save();
		}

		$this->redirect()->url("/admin/target-list?action=search&filterby=periode&bulan=".$request->bulan."&tahun=".$request->tahun);
		return;
	}

	function update(Request $request)
	{
		$periode = $request->bulan."-".$request->tahun;
		$pos_id = $request->pos;
		$model = Target::where("periode",$periode)->where("pos_id",$pos_id)->get();
		foreach ($model as $key => $value) {
			Target::delete($value->id);
		}
		
		foreach($request->jumlah as $key => $value){
			$target = new Target;
			$target->periode = $periode;
			$target->jumlah = $value;
			$target->pos_id = $request->pos;
			$target->kategori_id = $key;
			$target->save();
		}

		$this->redirect()->url("/admin/target-list?action=search&filterby=periode&bulan=".$request->bulan."&tahun=".$request->tahun);
		return;
	}

	function delete(Request $request)
	{
		$model = Target::where("periode",$request->periode)->where("pos_id",$request->pos_id)->get();
		foreach ($model as $key => $value) {
			Target::delete($value->id);
		}
		$periode = explode("-", $request->periode);
		$this->redirect()->url("/admin/target-list?action=search&filterby=periode&bulan=".$periode[0]."&tahun=".$periode[1]);
	}

}
