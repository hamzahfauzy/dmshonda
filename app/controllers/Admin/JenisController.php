<?php
namespace app\controllers\Admin;
use vendor\zframework\Controller;
use vendor\zframework\Session;
use vendor\zframework\util\Request;
use app\Jenis;
use app\Kategori;

class JenisController extends Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$jenis = Jenis::get();
		$data['jenis'] = $jenis;
		return $this->view->render("Admin.jenis.index")->with($data);
	}

	function add()
	{
		$kategori = Kategori::get();
		$error = isset($_GET['error']) ? $_GET['error'] : false;
		$data["kategori"] = $kategori;
		$data["error"] = $error;
		return $this->view->render("Admin.jenis.add-form")->with($data);
	}

	function edit($id)
	{
		$jenis = Jenis::find($id);
		$kategori = Kategori::get();
		$error = isset($_GET['error']) ? $_GET['error'] : false;
		$data["jenis"] = $jenis;
		$data["error"] = $error;
		$data["kategori"] = $kategori;
		return $this->view->render("Admin.jenis.edit-form")->with($data);
	}

	function insert(Request $request)
	{
		// check kategori exists
		$jenis = Jenis::where("nama",$request->nama)->first();
		if(!empty($jenis))
		{
			$this->redirect()->url("/admin/jenis-list/add?error=exists");
			return;
		}
		$param = (array) $request;
		$param["created_at"] = date("Y-m-d H:i:s");
		$param["updated_at"] = date("Y-m-d H:i:s");
		$jenis = new Jenis;
		if($jenis->save($param))
			$this->redirect()->url("/admin/jenis-list");
		return;
	}

	function update(Request $request)
	{
		$jenis = Jenis::where("nama",$request->nama)->first();
		if(!empty($jenis) && $jenis->id != $request->id)
		{
			$this->redirect()->url("/admin/jenis-list/edit/".$request->id."?error=exists");
			return;
		}

		$jenis = Jenis::where("id",$request->id)->first();
		$param = (array) $request;
		$param["updated_at"] = date("Y-m-d H:i:s");
		if($jenis->save($param))
			$this->redirect()->url("/admin/jenis-list");
		return;
	}

	function delete(Request $request)
	{
		Jenis::delete($request->id);
		$this->redirect()->url("/admin/jenis-list");
	}

}
