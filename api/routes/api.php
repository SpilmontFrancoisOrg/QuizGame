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
    return [
        'data' => 200,
        'meta' => [
            'success' => true,
            'message' => 'Quiz Game API'
        ]
    ];
});

Route::get('/games', 'App\Http\Controllers\GameController@index');
Route::post('/games/{game}/end', 'App\Http\Controllers\GameController@endGame');

Route::get('/games/leaderboard', 'App\Http\Controllers\GameController@leaderboard');

Route::get('/themes', 'App\Http\Controllers\ThemeController@index');
Route::post('/themes', 'App\Http\Controllers\ThemeController@store');

Route::post('/questions', 'App\Http\Controllers\QuestionController@store');
