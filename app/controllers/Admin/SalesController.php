<?php
namespace app\controllers\Admin;
use vendor\zframework\Controller;
use vendor\zframework\Session;
use vendor\zframework\util\Request;
use app\Sales;
use app\RelSalesPos;
use app\Pos;

class SalesController extends Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$pos = Pos::get();
		$sales = Sales::get();
		$data['pos'] = $pos;
		$data['sales'] = $sales;
		return $this->view->render("Admin.sales.index")->with($data);
	}

	function add()
	{
		$error = isset($_GET['error']) ? $_GET['error'] : false;
		return $this->view->render("Admin.sales.add-form")->with("error",$error);
	}

	function edit($id)
	{
		$sales = Sales::find($id);
		$error = isset($_GET['error']) ? $_GET['error'] : false;
		$data["sales"] = $sales;
		$data["error"] = $error;
		return $this->view->render("Admin.sales.edit-form")->with($data);
	}

	function insert(Request $request)
	{
		// check user exists
		$sales = Sales::where("NIK",$request->NIK)->first();
		if(!empty($sales))
		{
			$this->redirect()->url("/admin/sales-list/add?error=exists");
			return;
		}
		$param = (array) $request;
		$param["created_at"] = date("Y-m-d H:i:s");
		$param["updated_at"] = date("Y-m-d H:i:s");
		$sales = new Sales;
		if($sales->save($param))
			$this->redirect()->url("/admin/sales-list");
		return;
	}

	function update(Request $request)
	{
		$sales = Sales::where("NIK",$request->NIK)->first();
		if(!empty($sales) && $sales->id != $request->id)
		{
			$this->redirect()->url("/admin/sales-list/edit/".$request->id."?error=exists");
			return;
		}

		$sales = Sales::where("id",$request->id)->first();
		$param = (array) $request;
		$param["updated_at"] = date("Y-m-d H:i:s");
		if($sales->save($param))
			$this->redirect()->url("/admin/sales-list");
		return;
	}

	function delete(Request $request)
	{
		Sales::delete($request->id);
		$this->redirect()->url("/admin/sales-list");
	}

	function setpos(Request $request)
	{
		$model = new RelSalesPos;
		$model->sales_id = $request->sales_id;
		$model->pos_id = $request->pos_id;
		if($model->save())
		{
			$this->redirect()->url("/admin/sales-list");
		}
		return;
	}

	function editpos(Request $request)
	{
		$model = new RelSalesPos;
		$model->id = $request->id;
		$model->sales_id = $request->sales_id;
		$model->pos_id = $request->pos_id;
		if($model->save())
		{
			$this->redirect()->url("/admin/sales-list");
		}
		return;
	}

	function hapuspos(Request $request)
	{
		RelSalesPos::delete($request->id);
		$this->redirect()->url("/admin/sales-list");
		return;
	}

}
