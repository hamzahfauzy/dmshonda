<?php
namespace app\controllers\Admin;
use vendor\zframework\Controller;
use vendor\zframework\Session;
use vendor\zframework\util\Request;
use app\Pos;
use app\User;
use app\RelOperatorPos;

class PosController extends Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$pos = Pos::get();
		$operator = User::where("level",2)->get();
		$op = [];
		foreach ($operator as $key => $value) {
			$RelOperatorPos = RelOperatorPos::where("operator_id",$value->id)->first();
			if(empty($RelOperatorPos))
				$op[] = $value;
		}
		$data['pos'] = $pos;
		$data['operator'] = $op;
		return $this->view->render("Admin.pos.index")->with($data);
	}

	function add()
	{
		$error = isset($_GET['error']) ? $_GET['error'] : false;
		return $this->view->render("Admin.pos.add-form")->with("error",$error);
	}

	function edit($id)
	{
		$pos = Pos::find($id);
		$error = isset($_GET['error']) ? $_GET['error'] : false;
		$data["pos"] = $pos;
		$data["error"] = $error;
		return $this->view->render("Admin.pos.edit-form")->with($data);
	}

	function insert(Request $request)
	{
		// check pos exists
		$pos = Pos::where("nama",$request->nama)->first();
		if(!empty($pos))
		{
			$this->redirect()->url("/admin/pos-list/add?error=exists");
			return;
		}
		$param = (array) $request;
		$param["created_at"] = date("Y-m-d H:i:s");
		$param["updated_at"] = date("Y-m-d H:i:s");
		// print_r($param);
		// return;
		$pos = new Pos;
		if($pos->save($param))
			$this->redirect()->url("/admin/pos-list");
		return;
	}

	function update(Request $request)
	{
		$pos = Pos::where("nama",$request->nama)->first();
		if(!empty($pos) && $pos->id != $request->id)
		{
			$this->redirect()->url("/admin/pos-list/edit/".$request->id."?error=exists");
			return;
		}

		$pos = Pos::where("id",$request->id)->first();
		$param = (array) $request;
		$param["updated_at"] = date("Y-m-d H:i:s");
		if($pos->save($param))
			$this->redirect()->url("/admin/pos-list");
		return;
	}

	function delete(Request $request)
	{
		Pos::delete($request->id);
		$this->redirect()->url("/admin/pos-list");
	}

	function setoperator(Request $request)
	{
		$model = new RelOperatorPos;
		$model->pos_id = $request->pos_id;
		$model->operator_id = $request->operator;
		if($model->save())
		{
			$this->redirect()->url("/admin/pos-list");
		}
		return;
	}

	function editoperator(Request $request)
	{
		$model = RelOperatorPos::where("id",$request->id)->first();
		$model->pos_id = $request->pos_id;
		$model->operator_id = $request->operator;
		if($model->save())
		{
			$this->redirect()->url("/admin/pos-list");
		}
		return;
	}

	function hapusoperator(Request $request)
	{
		RelOperatorPos::delete($request->id);
		$this->redirect()->url("/admin/pos-list");
	}

}
