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

$this->group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function() {
	
	//Tipos de usuario
	$this->get('/role-cadastrar', 'RoleController@create')->name('cadastrar.role');
	$this->post('role', 'RoleController@store')->name('role.store');
	$this->get('/roles-listar', 'RoleController@index')->name('listar');
	$this->get('/role-listar/{role}', 'RoleController@show')->name('role.show');
	$this->get('/role-editar/{role}', 'RoleController@edit')->name('role.edit');
	$this->post('/role-update/{role}', 'RoleController@update')->name('role.update');
	$this->get('/role-deletar/{role}', 'RoleController@destroy')->name('role.delete');

	//Rotas Contas Banco
	$this->get('/cadastrar-banco', 'AccountBankController@create')->name('cadastrar.banco');
	$this->post('account-bank', 'AccountBankController@store')->name('bank.store');
	$this->get('/listar-contas', 'AccountBankController@index')->name('listar');

	//Rotas Usuarios
	$this->get('/usuario-cadastrar', 'UserController@create')->name('user.create');
	$this->post('user', 'UserController@store')->name('user.store');
	$this->get('/usuarios-listar', 'UserController@index')->name('listar');
	$this->get('/usuario-listar/{user}', 'UserController@show')->name('user.show');
	$this->get('/usuario-editar/{user}', 'UserController@edit')->name('user.edit');
	$this->get('/deletar-item/{user}', 'UserController@destroy')->name('user.delete');
    
    //Rotas Itens
    $this->get('/item-cadastrar', 'ItemController@create')->name('item.cadastrar');
    $this->post('item', 'ItemController@store')->name('item.store');

    $this->get('/itens-listar', 'ItemController@index')->name('itens.listar');
    $this->get('/item-listar/{item}', 'ItemController@show')->name('item.show');
    
    $this->get('/item-editar/{item}', 'ItemController@edit')->name('item.editar');
    $this->post('/item-update/{item}', 'ItemController@update')->name('item.update');

    $this->get('/item-deletar/{item}', 'ItemController@destroy')->name('item.deletar');
     
	//Rotas Categoria
	$this->get('/categoria-cadastrar', 'CategoryController@create')->name('category.create');
	$this->post('/category', 'CategoryController@store')->name('category.store');
	$this->get('/categorias-listar', 'CategoryController@index')->name('listar');
	$this->get('/categoria-editar/{category}', 'CategoryController@edit')->name('category.edit');
	$this->post('/category-update/{category}', 'CategoryController@update')->name('category.update');
	$this->get('/categoria-deletar/{category}', 'CategoryController@destroy')->name('category.delete');
    
    //Rotas Produto
	$this->get('/produto-cadastrar', 'ProductController@create')->name('product.create');
	$this->post('product', 'ProductController@store')->name('product.store');
	$this->get('/produtos-listar', 'ProductController@index')->name('listar');
	$this->get('/produto-listar/{product}', 'ProductController@show')->name('product.show');
	$this->get('/produto-editar/{product}', 'ProductController@edit')->name('product.edit');
	$this->post('/product-update/{product}', 'ProductController@update')->name('product.update');
	$this->get('/produto-deletar/{product}', 'ProductController@destroy')->name('product.delete');
    
    //Rotas Sale
	$this->get('/vendas-listar', 'SaleController@index')->name('listar');
	$this->get('/venda-listar/{sale}', 'SaleController@show')->name('sale.show');
	$this->get('/venda-editar/{sale}', 'SaleController@edit')->name('sale.edit');
	$this->post('/venda-update/{sale}', 'SaleController@update')->name('sale.update');
	$this->get('/venda-deletar/{sale}', 'SaleController@destroy')->name('sale.delete');

	//Rotas Service
	$this->get('/servicos-listar', 'ServiceController@index')->name('listar');
	$this->get('/servico-listar/{service}', 'ServiceController@show')->name('service.show');
	$this->get('/servico-editar/{service}', 'ServiceController@edit')->name('service.edit');
	$this->post('/servico-update/{service}', 'ServiceController@update')->name('service.update');
	$this->get('/servico-deletar/{service}', 'ServiceController@destroy')->name('sale.delete');

    //$this->get('/', 'AdminController@index')->name('admin.home');  


});

Route::get('/roles-permission', 'HomeController@rolesPermission');

Route::get('/admin', 'HomeController@index')->name('admin');
