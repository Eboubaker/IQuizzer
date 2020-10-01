<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Question;

class QuizController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth')->except('show');
    }
    public function index(){
        return "TODO";
    }
    public function create(){
        return view('quiz.create');
    }
    public function show(Quiz $quiz){
        if(Auth::id() === $quiz->author->id){
            return view('quiz.show', $quiz);
        }else{
            return redirect()->action('App\Http\Controllers\UserQuizController@create', $quiz);
        }
    }
    public function store(){
//        dd(request()['questions']);
//        dd(request()->all());
        $r = $this->validateRequest();
        $r['id'] = $this->generateId();
        $questions = [];
        foreach ($r['questions'] as $q){
            $q = (object)$q;
            $questions[] = new Question($q->question, $q->choices, [0], $q->point);
        }
        $r['questions'] = $questions;
        $r['author_id'] = Auth::id();
        $q = Quiz::create($r);
        return redirect($q->path);
    }

    /*--- Helpers ---*/
    public function generateId(){
        do {
            $id = Str::lower(Str::random(10));
        }while(Quiz::find($id) != null);
        return $id;
    }
    public function validateRequest(){
        return Validator::make(request()->all(), [
            'total_points' => 'required',
            'title' => 'required|between:5, 50',
            'questions' => 'required|between:3, 30',
            'questions.*.question' => 'required|between:3, 255',
            'questions.*.point' => 'required|numeric|min:0',
            'questions.*.choices' => 'required|between:2, 6',
            'questions.*.choices.*' => 'required|between:4, 255',
        ],[
            'title.required' => 'You must specify the Title of the quiz',
            'title.between' => 'The title must be at least 4 characters long',

            'questions.*.point.required' => 'You must set the question point',
            'questions.*.point.min' => 'Question point must be greater than 1',
            'questions.*.point.numeric' => 'Question point must be numeric',

            'questions.required' => 'You must make at least 3 questions',
            'questions.between' => 'You must make at least 3 questions',

            'questions.*.question.required' => 'You must specify the question',
            'questions.*.question.between' => 'The question must be at least 3 characters long',

            'questions.*.choices.required' => 'You must specify the question choices',
            'questions.*.choices.between' => 'You must make 2 to 6 choices per question',

            'questions.*.choices.*.required' => 'You must specify the choice',
            'questions.*.choices.*.between' => 'The question choice must be at least 4 characters long',
        ])->validate();
    }
}
