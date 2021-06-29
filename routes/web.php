<?php

use App\Http\Controllers\ExploreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserQuizController;
use App\Models\User;
use App\Models\UserQuiz;
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
//set_time_limit(500);
//Artisan::call('cache:clear');
//Artisan::call('view:clear');
//Artisan::call('route:clear');
//Artisan::call('config:clear');
//dd(Artisan::output());//
//dd(config('app.name'));

//foreach (range(0, 20) as $i)
//{
//    $answers=[];
//    $point = 0;
//    $quiz = \App\Models\Quiz::find('Cpl2JKhG');
//    $user = User::factory()->create();
//    foreach ($quiz->questions as $question)
//    {
//        if((rand(0, 100) * rand(0, 1564)) % 2 == 0)
//        {
//            $point += $question->point;
//            $answers[] = $question->choices[$question->correctChoices[0]];
//        }else{
//            $answers[] = $question->choices[rand(0, 2)];
//        }
//    }
//    UserQuiz::factory()->create([
//        'user_id' => $user->id,
//        'quiz_id' => $quiz->id,
//        'point' => $point,
//        'answers' => $answers
//    ]);
//}
//dd('done');
Auth::routes(['verify' => true]);

Route::get('/user/settings', [SettingsController::class, 'create'])->name('user.settings.create');
Route::post('/user/settings', [SettingsController::class, 'store'])->name('user.settings.store');

Route::get("/user/{user}", function(){ abort(403, "Still in Development");})->name("user.profile");

Route::get('/userQuiz/{userQuiz}', [UserQuizController::class, 'show'])->name('userQuiz.show');
Route::get('/userQuiz/new/{quiz}', [UserQuizController::class, 'create'])->name('userQuiz.create');
Route::post('/userQuiz/store/{quiz}', [UserQuizController::class, 'store'])->name('userQuiz.store');

Route::resource('quiz' , QuizController::class);

Route::get('/explore', [ExploreController::class, 'index'])->name('explore');

Route::get('/{home?}', [HomeController::class, 'index'])->name('home');
