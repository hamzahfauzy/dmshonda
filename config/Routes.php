<?php
use vendor\zframework\Route;
use vendor\zframework\util\Request;
use app\User;

Route::get("/top5sales","IndexController@top5sales");
Route::get("/salesgoals","IndexController@salesgoals");
Route::get("/targetsales","IndexController@targetsales");
Route::get("/stok","IndexController@stok");
Route::post("/logout","IndexController@logout");
Route::middleware("Login")->get("/login","IndexController@login");
Route::middleware("Login")->post("/login","IndexController@doLogin");
Route::middleware("Auth")->get("/","IndexController@index");

Route::middleware("Admin")->prefix("/admin")->namespaces("Admin")->group(function(){
	Route::get("/","IndexController@index");

	// Operator CRUD
	Route::get("/operator-list","OperatorController@index");
	Route::get("/operator-list/add","OperatorController@add");
	Route::get("/operator-list/edit/{id}","OperatorController@edit");
	Route::post("/operator-list/insert","OperatorController@insert");
	Route::post("/operator-list/update","OperatorController@update");
	Route::post("/operator-list/delete","OperatorController@delete");

	// Pos Dealer CRUD
	Route::get("/pos-list","PosController@index");
	Route::get("/pos-list/add","PosController@add");
	Route::get("/pos-list/edit/{id}","PosController@edit");
	Route::post("/pos-list/insert","PosController@insert");
	Route::post("/pos-list/update","PosController@update");
	Route::post("/pos-list/delete","PosController@delete");

	// Pos Operator
	Route::post("/pos-list/set-operator","PosController@setoperator");
	Route::post("/pos-list/edit-operator","PosController@editoperator");
	Route::post("/pos-list/hapus-operator","PosController@hapusoperator");

	// Kategori CRUD
	Route::get("/kategori-list","KategoriController@index");
	Route::get("/kategori-list/add","KategoriController@add");
	Route::get("/kategori-list/edit/{id}","KategoriController@edit");
	Route::post("/kategori-list/insert","KategoriController@insert");
	Route::post("/kategori-list/update","KategoriController@update");
	Route::post("/kategori-list/delete","KategoriController@delete");

	// Jenis Sepeda Motor CRUD
	Route::get("/jenis-list","JenisController@index");
	Route::get("/jenis-list/add","JenisController@add");
	Route::get("/jenis-list/edit/{id}","JenisController@edit");
	Route::post("/jenis-list/insert","JenisController@insert");
	Route::post("/jenis-list/update","JenisController@update");
	Route::post("/jenis-list/delete","JenisController@delete");

	// Unit Sepeda Motor CRUD
	Route::get("/unit-list","UnitController@index");
	Route::get("/unit-list/add","UnitController@add");
	Route::get("/unit-list/edit/{id}","UnitController@edit");
	Route::post("/unit-list/insert","UnitController@insert");
	Route::post("/unit-list/update","UnitController@update");
	Route::post("/unit-list/delete","UnitController@delete");

	// Unit Sepeda Motor POS
	Route::post("/unit-list/set-pos","UnitController@setpos");
	Route::post("/unit-list/edit-pos","UnitController@editpos");
	Route::post("/unit-list/hapus-pos","UnitController@hapuspos");


	// Sales CRUD
	Route::get("/sales-list","SalesController@index");
	Route::get("/sales-list/add","SalesController@add");
	Route::get("/sales-list/edit/{id}","SalesController@edit");
	Route::post("/sales-list/insert","SalesController@insert");
	Route::post("/sales-list/update","SalesController@update");
	Route::post("/sales-list/delete","SalesController@delete");

	// sales pos
	Route::post("/sales-list/set-pos","SalesController@setpos");
	Route::post("/sales-list/edit-pos","SalesController@editpos");
	Route::post("/sales-list/hapus-pos","SalesController@hapuspos");

	// Target CRUD
	Route::get("/target-list","TargetController@index");
	Route::get("/target-list/add","TargetController@add");
	Route::get("/target-list/edit/{periode}/{id}","TargetController@edit");
	Route::post("/target-list/insert","TargetController@insert");
	Route::post("/target-list/update","TargetController@update");
	Route::post("/target-list/delete","TargetController@delete");

	Route::get("/mutasi-list","IndexController@mutasi");
	Route::get("/penjualan-list","IndexController@penjualan");
});

Route::middleware("OperatorPos")->prefix("/operator")->namespaces("OperatorPos")->group(function(){
	Route::get("/","IndexController@index");

	// Sales List
	Route::get("/sales-list","IndexController@sales");

	// Stok list
	Route::get("/stok-list","IndexController@stok");

	// Unit list
	Route::get("/unit-list","IndexController@unit");

	// Set Penjualan
	Route::post("/set-penjualan","IndexController@setpenjualan");

	// Penjualan
	Route::get("/penjualan-list","IndexController@penjualan");
});