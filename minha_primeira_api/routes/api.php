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
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function(Request $request){
    // dd($request->headers->all());
    // dd($request->headers->get('Authorization'));

    $response = new \Illuminate\Http\Response(json_encode(['msg'=>'Minha primeira respost de API']));
    $response->header('Content-Type', 'application/json');

    return $response;
});


// Products Route
Route::namespace('Api')->prefix('products')->group(function(){
    Route::get('/', 'ProductController@index');
    Route::get('/{id}', 'ProductController@show');
    Route::post('/', 'ProductController@save');//->middleware('auth.basic');
    Route::put('/', 'ProductController@update');
    Route::delete('/{id}', 'ProductController@excluir');
});