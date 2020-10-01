<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserQuizController extends Controller
{
    function create(Quiz $quiz){
        $quiz->shuffleChoices();
        return view('userquiz.create', ["quiz" => $quiz]);
    }
    function store(){
        dd(request()->all());
    }
}
