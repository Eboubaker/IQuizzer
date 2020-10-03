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
Route::get("/user/{user}", function(){ abort(404);})->name("user.profile");
Route::get('/userQuiz/{userQuiz}', [UserQuizController::class, 'show'])->name('userQuiz.show');
Route::get('/userQuiz/new/{quiz}', [UserQuizController::class, 'create'])->name('userQuiz.create');
Route::post('/userQuiz/store/{quiz}', [UserQuizController::class, 'store'])->name('userQuiz.store');

Route::resource('quiz' , QuizController::class);
Route::get('/explore', function(){return "TODO";})->name('explore');
Route::get('/{home?}', [HomeController::class, 'index'])->name('home');
