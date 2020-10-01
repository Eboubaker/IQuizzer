<?php

namespace App\Models;

use App\HasUuid;
use App\Question;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Quiz extends Model
{
    public static $keyLength = 8;
    use HasFactory, HasUuid;
    protected $casts = [
        'questions' => 'object',
    ];
    protected $guarded = ['id'];
    public function usersQuiz(){
        return $this->hasMany(UserQuiz::class);
    }
    public function author(){
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function getPathAttribute()
    {
        return route('quiz.show', ['quiz' => $this->getKey()]);
    }
    public function getCreatedAtAttribute(){
        return Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }
    public function shuffleChoices(){
        $questions = (object)$this->questions;
        $shuffled = [];
        foreach($questions as $question) {
            $ans = [];
            foreach ($question->correctChoices as $c) {
                $ans[] = $question->choices[$c];
            }
            $question->correctChoices = [];
            $question->choices = collect($question->choices)->shuffle();
            foreach ($ans as $a) {
                $question->correctChoices[] = $question->choices->search($a);
            }
            $question->choices = $question->choices->toArray();
            $shuffled[] = $question;
        }
        $this->questions = $shuffled;
        return $shuffled;
    }
}
