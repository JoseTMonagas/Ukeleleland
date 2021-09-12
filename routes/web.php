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


Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['prefix' => 'voyager'], function () {
    Voyager::routes();
});

Route::get("test-recibo", function() {
    return view('webpay/exito');
});

Route::group(['prefix' => 'control', 'middleware' => ['auth', 'checkAdmin']], function() {
    Route::get('ukeprofe/solicitantes', 'TutorController@index')->name('tutor.index');
    Route::get('ukeprofe/revisar/{profile}', 'TutorController@revisar')->name('tutor.revisar');
    Route::get('ukeprofe/{profile}/estado/{estado}', 'TutorController@estado')->name('tutor.estado');

    Route::get('sales/index', 'SaleController@index')->name('sale.index');
    Route::get('sales/edit/{sale}', 'SaleController@edit')->name('sale.edit');
    Route::post('sales/edit/{sale}', 'SaleController@update')->name('sale.update');
});

Route::post('/buscar', 'SearchProducts')->name('search');

Route::group(['prefix' => 'ukeleles'], function () {
    Route::get('{slug?}', 'ProductController@index')->name('producto.index');
    Route::get('/mostrar/{product}', 'ProductController@show')->name('producto.show');
    Route::post('precios', 'ProductController@index')->name('producto.filtro');
});

Route::group(['prefix' => 'ebooks'], function () {
    Route::get('/', 'AssetController@index')->name('asset.index');
    Route::get('{asset}', 'AssetController@show')->name('asset.show');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/mi-perfil', 'ShowMiPerfil')->name('miPerfil');
Route::get('editar/perfil/{profile}', 'ProfileController@edit')->name('profile.edit');
Route::post('editar/perfil/{profile}', 'ProfileController@update')->name('profile.edit.post');
Route::get('crear/perfil', 'ProfileController@create')->name('profile.create');
Route::post('crear/perfil', 'ProfileController@store')->name('profile.store');

Route::get('ukeprofe/nuevo', 'TutorController@solicitar')->name('tutor.solicitar');
Route::post('ukeprofe/nuevo/{profile}', 'TutorController@realizarSolicitud')->name('tutor.realizarSolicitud');


Route::group(['prefix' => 'mi-carrito'], function () {
    Route::get('/', 'CartController@index')->name('cart.index');
    Route::post('actualizar', 'CartController@update')->name('cart.update');
    Route::delete('{product}', 'CartController@destroy')->name('cart.destroy');
});

// Cart Routes
Route::post('/add-product/{product}', 'CartController@storeProduct')->name('cart.store');
Route::post('/store-book/{book}', 'CartController@storeBook')->name('cart.asset');
Route::get('/check-product/{id}', 'CartController@checkIfProductInCart')->name('cart.check');

Route::post('/sale/iniciar', 'SaleController@webpaySale')->name('sale.init');
Route::get('/pagar', 'SaleController@create')->name('sale.index');
Route::post('/transferencia', 'SaleController@store')->name('sale.store');
Route::post('/transaccion', 'SaleController@startTransaction')->name('sale.start');
Route::post('/sale/return', 'SaleController@returnTransaction');
Route::get('/detalle/{sale}', 'SaleController@show')->name('sale.show');

Route::group(['prefix' => 'regions'], function () {
    Route::get('/', 'RegionController@getAll')->name('getRegions');
    Route::get('{region}', 'RegionController@getById')->name('getRegionById');
});
Route::group(['prefix' => 'communes'], function () {
    Route::get('{commune}', 'CommuneController@getById')->name('getCommuneById');
    Route::get('region/{region}', 'CommuneController@getByRegion')->name('GetCommunesRegion');
});

Route::get('/dispatch-price/{commune?}', 'getDispatchPriceController')->name('dispatchPrice');

Route::group(['prefix' => 'webpay'], function () {
    Route::get('init/{sale}', 'WebpayController@init')->name('webpay.init');
    Route::match(["get", "post"], 'voucher/{sale}', 'WebpayController@voucher')->name('webpay.voucher');
});

Route::group(['prefix' => 'blog'], function () {
    Route::get('{categoria?}', 'PostController@index')->name('blog.index');
    Route::get('post/{post}', 'PostController@show')->name('blog.show');
});

Route::group(['prefix' => 'ukeprofe'], function () {
    Route::resource('tutorias', 'TutoriaController')->except([
        "destroy"
    ]);
    Route::get('/', 'ProfileController@index')->name('ukeprofe.index');
    Route::post('/', 'ProfileController@indexComuna')->name('ukeprofe.indexComuna');

    Route::get('contactar/{profile}', 'ConversationController@store')->middleware('auth')->name('ukeprofe.chat');
    Route::get('mostrar/{profile}', 'ProfileController@show')->name('ukeprofe.show');

    Route::get('tutorias/{tutoria}/clases', 'ClaseController@index')->name('clases.index');
    Route::resource('tutorias/{tutoria}/clases', 'ClaseController', [
        "names" => [
            'index' => 'clases.index',
            'create' => 'clases.create',
            'store' => 'clases.store',
            'edit' => 'clases.edit',
            'update' => 'clases.update'
        ]
    ])->except([
        'index', 'destroy'
    ]);
});

Route::group(['prefix' => 'chat'], function () {
    Route::get('{conversation?}', 'ChatController@index')->name('chat.index');
    Route::get('{conversation}/messages', 'ChatController@fetchMessages')->name('messages');
    Route::post('{conversation}/messages/store', 'ChatController@sendMessage')->name('messages.store');
});

Route::post('/aplicar-coupon', 'CouponController@store')->name('coupon.store');
Route::delete('/borrar-coupon', 'CouponController@destroy')->name('coupon.destroy');

Route::get('/informacion-limite', 'LimitController@show')->name('infoLimite');
Route::post('/limite/webpay', 'LimitController@liberarWebpay')->name('liberar.webpay');
Route::post('/limite/transferencia', 'LimitController@liberarTransferencia')->name('liberar.transferencia');

Route::get('/terminos-condiciones', 'ShowTerminosCondiciones')->name('terminosYCondiciones');
Route::get('/formas-envio', 'ShowFormasEnvio')->name('formasEnvio');
Route::get('/privacidad', 'ShowPrivacidad')->name('privacidad');
Route::get('/metodos-pago', 'ShowMetodosPago')->name('metodosPago');
Route::get('/suscribete', 'ShowSubscribe')->name('showSubscribe');

Route::get('/contactanos', 'ContactController@show')->name('contactShow');
Route::post('/contactanos', 'ContactController@contact')->name('contact');
Route::get('/preguntas_frecuentes', 'ExtraController@preguntas_frecuentes')->name('preguntas_frecuentes');

Route::get('/contactanos', 'ContactController@show')->name('contactShow');
Route::post('/contactanos', 'ContactController@contact')->name('contact');
Route::get('/sorteo_y_preventa', 'ExtraController@sorteo_y_preventa')->name('sorteo_y_preventa');

Route::group(["prefix" => "nova-control"], function() {
    Route::resources([
        "productos" => "ProductoCRUDController",
    ]);
});
