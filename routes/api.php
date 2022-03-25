<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => 'website'], function (){
    Route::get('test', function (){
        return response()->json(['message'=>'test']);
    });
    Route::post('{websiteId}/post', [PostController::class, 'store']);
});

Route::group(['prefix' => 'user'], function (){
    Route::post('{id}/subscribe/{websiteId}', [UserController::class, 'subscribe']);
});
