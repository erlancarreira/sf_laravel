<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function() {
	
	//Tipos de usuario
	Route::get('/role-cadastrar', 'RoleController@create')->name('role.create');
	Route::post('role', 'RoleController@store')->name('role.store');
	Route::get('/roles-listar', 'RoleController@index')->name('role.list');
	Route::get('/role-listar/{role}', 'RoleController@show')->name('role.show');
	Route::get('/role-editar/{role}', 'RoleController@edit')->name('role.edit');
	Route::post('/role-update/{role}', 'RoleController@update')->name('role.update');
	Route::get('/role-deletar/{role}', 'RoleController@destroy')->name('role.delete');

	//Rotas Contas Banco
	Route::get('/banco-cadastrar', 'AccountBankController@create')->name('account-bank.create');
	Route::post('bank', 'AccountBankController@store')->name('account-bank.store');
	Route::get('/banco-editar/{bank}', 'AccountBankController@edit')->name('account-bank.edit');
	Route::post('/bank-update/{bank}', 'AccountBankController@update')->name('account-bank.update');
	Route::get('/bancos-listar', 'AccountBankController@index')->name('account-bank.list');
	Route::get('/banco-deletar/{bank}', 'AccountBankController@destroy')->name('account-bank.delete');

	//Rotas Usuarios
	Route::get('/usuario-cadastrar', 'UserController@create')->name('user.create');
	Route::post('user', 'UserController@store')->name('user.store');
	Route::get('/usuarios-listar', 'UserController@index')->name('user.list');
	Route::get('/usuario-listar/{user}', 'UserController@show')->name('user.show');
	Route::get('/usuario-editar/{user}', 'UserController@edit')->name('user.edit');
	Route::get('/usuario-deletar/{user}', 'UserController@destroy')->name('user.delete');
    
    //Rotas Itens
    Route::get('/item-cadastrar', 'ItemController@create')->name('item.create');
    Route::post('item', 'ItemController@store')->name('item.store');
    Route::get('/itens-listar', 'ItemController@index')->name('item.list');
    Route::get('/item-listar/{item}', 'ItemController@show')->name('item.show');
    Route::get('/item-editar/{item}', 'ItemController@edit')->name('item.edit');
    Route::post('/item-update/{item}', 'ItemController@update')->name('item.update');
    Route::get('/item-deletar/{item}', 'ItemController@destroy')->name('item.delete');
     
	//Rotas Categoria
	Route::get('/categoria-cadastrar', 'CategoryController@create')->name('category.create');
	Route::post('/category', 'CategoryController@store')->name('category.store');
	Route::get('/categorias-listar', 'CategoryController@index')->name('category.list');
	Route::get('/categoria-editar/{category}', 'CategoryController@edit')->name('category.edit');
	Route::post('/category-update/{category}', 'CategoryController@update')->name('category.update');
	Route::get('/categoria-deletar/{category}', 'CategoryController@destroy')->name('category.delete');
    
    //Rotas Produto
	Route::get('/produto-cadastrar', 'ProductController@create')->name('product.create');
	Route::post('product', 'ProductController@store')->name('product.store');
	Route::get('/produtos-listar', 'ProductController@index')->name('product.list');
	Route::get('/produto-listar/{product}', 'ProductController@show')->name('product.show');
	Route::get('/produto-editar/{product}', 'ProductController@edit')->name('product.edit');
	Route::post('/product-update/{product}', 'ProductController@update')->name('product.update');
	Route::get('/produto-deletar/{product}', 'ProductController@destroy')->name('product.delete');
    
    //Rotas Sale
	Route::get('/vendas-listar', 'SaleController@index')->name('sale.list');
	Route::get('/venda-listar/{sale}', 'SaleController@show')->name('sale.show');
	Route::get('/venda-editar/{sale}', 'SaleController@edit')->name('sale.edit');
	Route::post('/venda-update/{sale}', 'SaleController@update')->name('sale.update');
	Route::get('/venda-deletar/{sale}', 'SaleController@destroy')->name('sale.delete');

	//Rotas Service
	Route::get('/servicos-listar', 'ServiceController@index')->name('service.list');
	Route::get('/servico-listar/{service}', 'ServiceController@show')->name('service.show');
	Route::get('/servico-editar/{service}', 'ServiceController@edit')->name('service.edit');
	Route::post('/servico-update/{service}', 'ServiceController@update')->name('service.update');
	Route::get('/servico-deletar/{service}', 'ServiceController@destroy')->name('sale.delete');

	//Rotas Bill
	Route::get('/contas-pagar-listar', 'BillController@index')->name('bill.list');
	
	// Route::get('/conta-pagar-editar/{bills}', 'BillController@edit')->name('bill.edit');
	// Route::post('/conta-pagar-update/{bills}', 'BillController@update')->name('bill.update');
	// Route::get('/conta-pagar-deletar/{bills}', 'BillController@destroy')->name('bill.delete');

    //Route::get('/', 'AdminController@index')->name('admin.home');  
});

Route::get('/roles-permission', 'HomeController@rolesPermission');

Route::get('/admin', 'HomeController@index')->name('admin');
