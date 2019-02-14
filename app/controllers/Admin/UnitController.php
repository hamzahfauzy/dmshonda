<?php
namespace app\controllers\Admin;
use vendor\zframework\Controller;
use vendor\zframework\Session;
use vendor\zframework\util\Request;
use app\Jenis;
use app\Unit;
use app\Pos;
use app\Mutasi;
use app\Stok;

class UnitController extends Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$pos = Pos::get();
		$data['pos'] = $pos;
		$is_search = isset($_GET['action']) && $_GET['action'] == "search";
		$unit = $is_search ? Unit::where($_GET['filterby'],$_GET['keyword'])->get() : Unit::get();
		$data['unit'] = $unit;
		return $this->view->render("Admin.unit.index")->with($data);
	}

	function add()
	{
		$jenis = Jenis::get();
		$error = isset($_GET['error']) ? $_GET['error'] : false;
		$data["jenis"] = $jenis;
		$data["error"] = $error;
		return $this->view->render("Admin.unit.add-form")->with($data);
	}

	function edit($id)
	{
		$unit = Unit::find($id);
		$jenis = Jenis::get();
		$error = isset($_GET['error']) ? $_GET['error'] : false;
		$data["jenis"] = $jenis;
		$data["error"] = $error;
		$data["unit"] = $unit;
		return $this->view->render("Admin.unit.edit-form")->with($data);
	}

	function insert(Request $request)
	{
		// check kategori exists
		$unit = Unit::where("no_mesin",$request->no_mesin)->first();
		if(!empty($unit))
		{
			$this->redirect()->url("/admin/unit-list/add?error=exists");
			return;
		}
		$param = (array) $request;
		$param["created_at"] = date("Y-m-d H:i:s");
		$param["updated_at"] = date("Y-m-d H:i:s");
		$unit = new Unit;
		if($unit->save($param))
			$this->redirect()->url("/admin/unit-list");
		return;
	}

	function update(Request $request)
	{
		$unit = Unit::where("no_mesin",$request->no_mesin)->first();
		if(!empty($unit) && $unit->id != $request->id)
		{
			$this->redirect()->url("/admin/unit-list/edit/".$request->id."?error=exists");
			return;
		}

		$unit = Unit::where("id",$request->id)->first();
		$param = (array) $request;
		$param["updated_at"] = date("Y-m-d H:i:s");
		if($unit->save($param))
			$this->redirect()->url("/admin/unit-list");
		return;
	}

	function delete(Request $request)
	{
		Unit::delete($request->id);
		$this->redirect()->url("/admin/jenis-list");
	}

	function setpos(Request $request)
	{
		$model = Unit::where('id',$request->id)->first();
		$model->pos_id = $request->pos_id;
		$jenis = $model->jenis()->id;
		if($model->save())
		{
			$stok = Stok::where("jenis_sm_id",$jenis)->where("pos_id",$request->pos_id)->first();
			if(empty($stok))
			{
				$stok = new Stok;
				$stok->pos_id = $request->pos_id;
				$stok->jenis_sm_id = $jenis;
				$stok->jumlah = 1;
			}else{
				$stok->jumlah = $stok->jumlah+1;
			}
			$stok->save();
			$this->redirect()->url("/admin/unit-list");
		}
		return;
	}

	function editpos(Request $request)
	{
		$model = Unit::where('id',$request->id)->first();
		$old_pos_id = $model->pos_id;
		$new_pos_id = $request->pos_id;
		$model->pos_id = $new_pos_id;
		$jenis = $model->jenis()->id;
		if($model->save())
		{
			$mutasi = new Mutasi;
			$mutasi->unit_id = $request->id;
			$mutasi->asal_pos_id = $old_pos_id;
			$mutasi->tujuan_pos_id = $new_pos_id;
			$mutasi->created_at = date("Y-m-d H:i:s");
			$mutasi->save();

			$old_stok = Stok::where("jenis_sm_id",$jenis)->where("pos_id",$old_pos_id)->first();
			$old_stok->jumlah = $old_stok->jumlah-1;
			$old_stok->save();

			$stok = Stok::where("jenis_sm_id",$jenis)->where("pos_id",$new_pos_id)->first();
			if(empty($stok))
			{
				$stok = new Stok;
				$stok->pos_id = $new_pos_id;
				$stok->jenis_sm_id = $jenis;
				$stok->jumlah = 1;
			}else{
				$stok->jumlah = $stok->jumlah+1;
			}
			$stok->save();

			$this->redirect()->url("/admin/unit-list");
		}
		return;
	}

	function hapuspos(Request $request)
	{
		$model = Unit::where('id',$request->id)->first();
		$pos_id = $model->pos_id;
		$model->pos_id = "NULL";
		$jenis = $model->jenis()->id;
		if($model->save())
		{
			$stok = Stok::where("jenis_sm_id",$jenis)->where("pos_id",$pos_id)->first();
			if(!empty($stok))
			{
				$stok->jumlah = $stok->jumlah-1;
				$stok->save();
			}
			$this->redirect()->url("/admin/unit-list");
		}
		return;
	}

}
