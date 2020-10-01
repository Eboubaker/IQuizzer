<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserQuizController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
//Artisan::call('migrate:refresh', ["--seed"=>true]);
//dd(Artisan::output());
Auth::routes();
Route::get('/userquiz/create/{quiz}', [UserQuizController::class, 'create']);
Route::post('/userquiz/{quiz}')->name('userquiz.store');
Route::resource('quiz' , QuizController::class);
Route::get('/explore', function(){return "TODO";})->name('explore');
Route::get('/{home?}', [HomeController::class, 'index'])->name('home');
