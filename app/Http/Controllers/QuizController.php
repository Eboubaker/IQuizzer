<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use App\Models\UserQuiz;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Question;
use stdClass;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('quiz.index', [
            "quizzes" => Quiz::where('author_id', Auth::id())->with('usersQuiz')->get()->each(function($quiz){
                if(count($quiz->usersQuiz) > 0)
                {
                    $avg = 0.0;
                    foreach ($quiz->usersQuiz as $userQuiz)
                    {
                        $avg += $userQuiz->point;
                    }
                    $quiz->avg = round($avg / count($quiz->usersQuiz), 1);
                }
            }),
            "userQuizzes" => UserQuiz::where('user_id', Auth::id())->with("quiz")->get(),
        ]);
    }
    public function create(){
        return view('quiz.create');
    }
    public function show($quizId){
        $quiz = Quiz::where("id", $quizId)->with(['usersQuiz', 'usersQuiz.user'])->first();
        if(!$quiz)
        {
            abort(404);
        }
        $quiz['title'] = strtoupper($quiz['title'][0]).substr($quiz['title'], 1);
        if(Auth::id() === $quiz->author->id)
        {
            $users = [];
            foreach($quiz->usersQuiz as $userQuiz)
            {
                $u = new stdClass;
                $u->path = $userQuiz->path;
                $u->name = $userQuiz->user->name;
                $u->point = $userQuiz->point;
                $u->email = $userQuiz->user->email;
                $u->createdAt = strval($userQuiz->created_at);
                $users[] = $u;
             }
            return view('quiz.show', ["quiz"=>$quiz, "users"=>json_encode($users)]);
        }
        else
        {
            return redirect()->action('App\Http\Controllers\UserQuizController@create', $quiz);
        }
    }
    public function store(){
//        dd(request()['questions']);
//        dd(request()->all());
        $r = $this->validateRequest();
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
        ])->validate();

    }
}
