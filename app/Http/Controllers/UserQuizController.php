<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Quiz;
use App\Models\UserQuiz;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserQuizController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    function create(Quiz $quiz)
    {
        /*if($quiz->mustVerify)
        {
            $this->middleware('verified');
        }*/
        if($q = UserQuiz::where('user_id', Auth::id())->where('quiz_id', $quiz->id)->first())
        {
            return redirect()->route('userQuiz.show', ['userQuiz' => $q]);
        }
        $quiz->shuffleChoices();
        return view('userQuiz.create', ["quiz" => $quiz]);
    }

    function store(Quiz $quiz)
    {
        if (!$quiz || empty($quiz->id))
        {
            abort(404);
        }
        if($uquiz = UserQuiz::where('user_id', Auth::id())->where('quiz_id', $quiz->id)->select('id')->first())
        {
            return redirect($uquiz->path);
        }
        $count = count($quiz->questions);
        request()->validate([
            "answers" => "required|min:{$count}|max:{$count}",
        ]);
        $point = 0;
        $questions = $quiz->questions;
        $answers = request()['answers'];
        if (count($answers) !== count($questions))
        {
            abort(404);
        }
        foreach ($questions as $index => $question)
        {
            if ($question->choices[$question->correctChoices[0]] === trim($answers[$index]))
            {
                $point += $question->point;
            }
        }
        $userQuiz = UserQuiz::create([
            "quiz_id" => $quiz->id,
            "user_id" => Auth::id(),
            "answers" => request()['answers'],
            "point" => $point,
        ]);
        return redirect($userQuiz->path);
    }

    function show(UserQuiz $userQuiz)
    {
//        Auth::user()->division_unit = 100;
        if(Auth::id() != $userQuiz->quiz->author->id && Auth::id() != $userQuiz->user->id)
        {
            return abort(403, "You don't own this Quiz, Thus can't view results of participants");
        }
        $userQuiz->point = Helper::topoint($userQuiz->point, $userQuiz->quiz->totalPoints );
        return view("userQuiz.show", [
            "questions" => $userQuiz->quiz->questions,
            "answers" => $userQuiz->answers,
            "quiz" => $userQuiz->quiz,
            "userQuiz" => $userQuiz,
        ]);
    }
}
