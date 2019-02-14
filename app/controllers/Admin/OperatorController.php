<?php
namespace app\controllers\Admin;
use vendor\zframework\Controller;
use vendor\zframework\Session;
use vendor\zframework\util\Request;
use app\User;

class OperatorController extends Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$user = User::where("level",2)->get();
		return $this->view->render("Admin.operator.index")->with("users",$user);
	}

	function add()
	{
		$error = isset($_GET['error']) ? $_GET['error'] : false;
		return $this->view->render("Admin.operator.add-form")->with("error",$error);
	}

	function edit($id)
	{
		$user = User::find($id);
		$error = isset($_GET['error']) ? $_GET['error'] : false;
		$data["user"] = $user;
		$data["error"] = $error;
		return $this->view->render("Admin.operator.edit-form")->with($data);
	}

	function insert(Request $request)
	{
		// check user exists
		$user = User::where("username",$request->username)->first();
		if(!empty($user))
		{
			$this->redirect()->url("/admin/operator-list/add?error=exists");
			return;
		}
		$param = (array) $request;
		$user = new User;
		$param["password"] = password_hash($request->password, PASSWORD_DEFAULT);
		$param["level"] = 2;
		if($user->save($param))
			$this->redirect()->url("/admin/operator-list");
		return;
	}

	function update(Request $request)
	{
		$user = User::where("username",$request->username)->first();
		if(!empty($user) && $user->id != $request->id)
		{
			$this->redirect()->url("/admin/operator-list/edit/".$request->id."?error=exists");
			return;
		}

		$user = User::where("id",$request->id)->first();
		$param = (array) $request;
		$param["password"] = password_hash($request->password, PASSWORD_DEFAULT);
		if(empty($request->password))
			unset($param["password"]);
		if($user->save($param))
			$this->redirect()->url("/admin/operator-list");
		return;
	}

	function delete(Request $request)
	{
		User::delete($request->id);
		$this->redirect()->url("/admin/operator-list");
	}

}
