<?php
namespace app\controllers\Admin;
use vendor\zframework\Controller;
use vendor\zframework\Session;
use vendor\zframework\util\Request;
use app\Kategori;

class KategoriController extends Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$kategori = Kategori::get();
		$data['kategori'] = $kategori;
		return $this->view->render("Admin.kategori.index")->with($data);
	}

	function add()
	{
		$error = isset($_GET['error']) ? $_GET['error'] : false;
		return $this->view->render("Admin.kategori.add-form")->with("error",$error);
	}

	function edit($id)
	{
		$kategori = Kategori::find($id);
		$error = isset($_GET['error']) ? $_GET['error'] : false;
		$data["kategori"] = $kategori;
		$data["error"] = $error;
		return $this->view->render("Admin.kategori.edit-form")->with($data);
	}

	function insert(Request $request)
	{
		// check kategori exists
		$kategori = Kategori::where("nama",$request->nama)->first();
		if(!empty($kategori))
		{
			$this->redirect()->url("/admin/kategori-list/add?error=exists");
			return;
		}
		$param = (array) $request;
		$kategori = new Kategori;
		if($kategori->save($param))
			$this->redirect()->url("/admin/kategori-list");
		return;
	}

	function update(Request $request)
	{
		$kategori = Kategori::where("nama",$request->nama)->first();
		if(!empty($kategori) && $kategori->id != $request->id)
		{
			$this->redirect()->url("/admin/kategori-list/edit/".$request->id."?error=exists");
			return;
		}

		$kategori = Kategori::find($request->id);
		$param = (array) $request;
		if($kategori->save($param))
			$this->redirect()->url("/admin/kategori-list");
		return;
	}

	function delete(Request $request)
	{
		Kategori::delete($request->id);
		$this->redirect()->url("/admin/kategori-list");
	}

}
