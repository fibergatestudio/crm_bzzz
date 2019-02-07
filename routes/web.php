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

Route::get('/', 'CrmController@login')->name('login');
//Auth::routes();
Route::post('/auth', 'CrmController@loginToCrm')->name('auth');
Route::get('/logout', 'CrmController@logout')->name('logout');
Route::get('/panel', 'AdminController@index')->name('index');
Route::get('/panel/categories', 'AdminController@categories')->name('categories');
Route::get('/panel/categories/create', 'AdminController@categoriesCreate')->name('categories::create');
Route::get('/panel/categories/edit/{id}', 'AdminController@categoriesEdit')->name('categories::edit');
Route::post('/panel/categories/update', 'AdminController@categoriesUpdate')->name('categories::update');
Route::get('/panel/goods', 'AdminController@goods')->name('goods');
Route::get('/panel/goods/create', 'AdminController@goodsCreate')->name('goods::create');
Route::get('/panel/goods/edit/{id}', 'AdminController@goodsEdit')->name('goods::edit');
Route::post('/panel/goods/update', 'AdminController@goodsUpdate')->name('goods::update');
Route::get('/panel/stocks', 'AdminController@stocks')->name('stocks');
Route::get('/panel/providers', 'AdminController@providers')->name('providers');
Route::get('/panel/providers/create', 'AdminController@providersCreate')->name('providers::create');
Route::get('/panel/providers/edit/{id}', 'AdminController@providersEdit')->name('providers::edit');
Route::post('/panel/providers/update', 'AdminController@providersUpdate')->name('providers::update');
Route::get('/panel/stocks', 'AdminController@stocks')->name('stocks');
Route::get('/panel/stocks/create', 'AdminController@stocksCreate')->name('stocks::create');
Route::get('/panel/stocks/edit/{id}', 'AdminController@stocksEdit')->name('stocks::edit');
Route::post('/panel/stocks/update', 'AdminController@stocksUpdate')->name('stocks::update');
Route::get('/panel/purchases', 'AdminController@purchases')->name('purchases');
Route::get('/panel/purchases/create', 'AdminController@purchasesCreate')->name('purchases::create');
Route::get('/panel/purchases/read/{id}', 'AdminController@purchasesRead')->name('purchases::read');
Route::post('/panel/purchases/update', 'AdminController@purchasesEdit')->name('purchases::update');
Route::get('/panel/orders', 'AdminController@orders')->name('orders');
//Страница нового заказа по номеру телефона
Route::get('/panel/orders/neworder', 'AdminController@neworder')->name('neworder');
    //Создание нового заказа
    Route::post('/panel/orders/neworder/create', 'AdminController@createNewOrder')->name('createneworder');

Route::get('/panel/orders/create', 'AdminController@ordersCreate')->name('orders::create');
Route::get('/panel/orders/edit/{id}', 'AdminController@ordersEdit')->name('orders::edit');
Route::get('/panel/orders/read/{id}', 'AdminController@ordersRead')->name('orders::read');
Route::post('/panel/orders/update', 'AdminController@ordersUpdate')->name('orders::update');
Route::get('/panel/clients', 'AdminController@clients')->name('clients');
Route::get('/panel/clients/create', 'AdminController@clientsCreate')->name('clients::create');
Route::get('/panel/clients/edit/{id}', 'AdminController@clientsEdit')->name('clients::edit');
Route::post('/panel/clients/update', 'AdminController@clientsUpdate')->name('clients::update');
Route::get('/panel/currencies', 'AdminController@currencies')->name('currencies');
Route::get('/panel/currencies/create', 'AdminController@currenciesCreate')->name('currencies::create');
Route::get('/panel/currencies/edit/{id}', 'AdminController@currenciesEdit')->name('currencies::edit');
Route::post('/panel/currencies/update', 'AdminController@currenciesUpdate')->name('currencies::update');
//NP Controller
Route::get('/panel/np', 'AdminController@makeNP')->name('np');
Route::get('/panel/sends', 'AdminController@sends')->name('sends');
Route::get('/panel/sends/np', 'AdminController@sendsNp')->name('sends::np');
Route::get('/panel/sends/sms', 'AdminController@sendsSms')->name('sends::sms');

Route::get('/panel/sends/testsms', 'AdminController@testSms')->name('sends::testsms');
// Parser Controller
Route::get('/parse/goods', 'ParserController@goods')->name('parse::goods');
Route::get('/parse/goods/single', 'ParserController@goodsSingle')->name('parse::goods::single');
Route::get('/parse/goods/base', 'ParserController@goodsBase')->name('parse::goods::base');
// API Controller
Route::get('/api/get/categories', 'ApiController@getCategories')->name('api::get::categories');
Route::get('/api/save/category', 'ApiController@saveCategory')->name('api::save::category');
Route::get('/api/get/goods', 'ApiController@getGoods')->name('api::get::goods');
Route::get('/api/save/good', 'ApiController@saveGood')->name('api::save::good');
Route::get('/api/get/sitecategories', 'ApiController@getSiteCategories')->name('api::get::sitecategories');
Route::get('/api/get/orders', 'ApiController@getOrders')->name('api::get::orders');

//NOVA poshta
//Route::get('/novaposhta', 'NovaPoshtaController@index');