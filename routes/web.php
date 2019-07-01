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
	Route::get('/role-cadastrar', 'RoleController@create')->name('cadastrar.role');
	Route::post('role', 'RoleController@store')->name('role.store');
	Route::get('/roles-listar', 'RoleController@index')->name('listar');
	Route::get('/role-listar/{role}', 'RoleController@show')->name('role.show');
	Route::get('/role-editar/{role}', 'RoleController@edit')->name('role.edit');
	Route::post('/role-update/{role}', 'RoleController@update')->name('role.update');
	Route::get('/role-deletar/{role}', 'RoleController@destroy')->name('role.delete');

	//Rotas Contas Banco
	Route::get('/cadastrar-banco', 'AccountBankController@create')->name('cadastrar.banco');
	Route::post('account-bank', 'AccountBankController@store')->name('bank.store');
	Route::get('/listar-contas', 'AccountBankController@index')->name('listar');

	//Rotas Usuarios
	Route::get('/usuario-cadastrar', 'UserController@create')->name('user.create');
	Route::post('user', 'UserController@store')->name('user.store');
	Route::get('/usuarios-listar', 'UserController@index')->name('listar');
	Route::get('/usuario-listar/{user}', 'UserController@show')->name('user.show');
	Route::get('/usuario-editar/{user}', 'UserController@edit')->name('user.edit');
	Route::get('/deletar-item/{user}', 'UserController@destroy')->name('user.delete');
    
    //Rotas Itens
    Route::get('/item-cadastrar', 'ItemController@create')->name('item.cadastrar');
    Route::post('item', 'ItemController@store')->name('item.store');

    Route::get('/itens-listar', 'ItemController@index')->name('itens.listar');
    Route::get('/item-listar/{item}', 'ItemController@show')->name('item.show');
    
    Route::get('/item-editar/{item}', 'ItemController@edit')->name('item.editar');
    Route::post('/item-update/{item}', 'ItemController@update')->name('item.update');

    Route::get('/item-deletar/{item}', 'ItemController@destroy')->name('item.deletar');
     
	//Rotas Categoria
	Route::get('/categoria-cadastrar', 'CategoryController@create')->name('category.create');
	Route::post('/category', 'CategoryController@store')->name('category.store');
	Route::get('/categorias-listar', 'CategoryController@index')->name('listar');
	Route::get('/categoria-editar/{category}', 'CategoryController@edit')->name('category.edit');
	Route::post('/category-update/{category}', 'CategoryController@update')->name('category.update');
	Route::get('/categoria-deletar/{category}', 'CategoryController@destroy')->name('category.delete');
    
    //Rotas Produto
	Route::get('/produto-cadastrar', 'ProductController@create')->name('product.create');
	Route::post('product', 'ProductController@store')->name('product.store');
	Route::get('/produtos-listar', 'ProductController@index')->name('listar');
	Route::get('/produto-listar/{product}', 'ProductController@show')->name('product.show');
	Route::get('/produto-editar/{product}', 'ProductController@edit')->name('product.edit');
	Route::post('/product-update/{product}', 'ProductController@update')->name('product.update');
	Route::get('/produto-deletar/{product}', 'ProductController@destroy')->name('product.delete');
    
    //Rotas Sale
	Route::get('/vendas-listar', 'SaleController@index')->name('listar');
	Route::get('/venda-listar/{sale}', 'SaleController@show')->name('sale.show');
	Route::get('/venda-editar/{sale}', 'SaleController@edit')->name('sale.edit');
	Route::post('/venda-update/{sale}', 'SaleController@update')->name('sale.update');
	Route::get('/venda-deletar/{sale}', 'SaleController@destroy')->name('sale.delete');

	//Rotas Service
	Route::get('/servicos-listar', 'ServiceController@index')->name('listar');
	Route::get('/servico-listar/{service}', 'ServiceController@show')->name('service.show');
	Route::get('/servico-editar/{service}', 'ServiceController@edit')->name('service.edit');
	Route::post('/servico-update/{service}', 'ServiceController@update')->name('service.update');
	Route::get('/servico-deletar/{service}', 'ServiceController@destroy')->name('sale.delete');

    //Route::get('/', 'AdminController@index')->name('admin.home');  


});

Route::get('/roles-permission', 'HomeController@rolesPermission');

Route::get('/admin', 'HomeController@index')->name('admin');
