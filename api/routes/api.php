<?php

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

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the API',
        'status' => 'success'
    ]);
});

Route::get('/games', 'App\Http\Controllers\GameController@index');

Route::post('/themes', 'App\Http\Controllers\ThemeController@store');

Route::post('/questions', 'App\Http\Controllers\QuestionController@store');
