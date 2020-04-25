<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!


	Route::name('route_name')->post('route', 'controller');
	
	//crear ruta y restricciones
	Route::resource('route', 'controller', ['except' => ['create', 'edit']]);
*/

Route::name('login')->post('', ''); #passport me obliga a tener login

Route::resource('tests', 'Test\TestController', ['except' => ['create', 'edit']]);


