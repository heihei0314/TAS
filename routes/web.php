<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
use App\Http\Controllers\dataController; 

//index page
Route::get('/', [dataController::class, 'index']);

//show all athletes
Route::get('athletes/', [dataController::class, 'getAthletes']);

//show an athlete's game data
Route::get('/gameData/{athlete}', [dataController::class, 'getGameData']);

//show an athlete's profile
Route::get('/profile/{athlete}', [dataController::class, 'getProfile']);

//show athletes' predicted win rate
Route::get('/winRate/{athlete1}/{athlete2}', [dataController::class, 'getWinRate']);

// win rate effect
Route::get('/effect', [dataController::class, 'getEffect']);

/*metrics*/
Route::get('/health', function () {
    //return $response->ok(); 
    return view('metrics.health');
});

Route::get('/metrics', function () {
    return view('metrics.metrics');
});
/*metrics*/
?>