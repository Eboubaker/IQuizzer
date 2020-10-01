<?php

namespace App;
class Question
{
    public $question;
    public $choices;
    public $correctChoices;
    public $point;

    public function __construct(string $question, array $choices, array $correctChoices, float $point)
    {
        $this->question = $question;
        $this->choices = $choices;
        $this->correctChoices = $correctChoices;
        $this->point = $point;
    }
    public function shuffle() : Question{
        $ans = [];
        foreach ($this->correctChoices as $c){
            $ans[] = $this->choices[$c];
        }
        $this->correctChoices = [];
        $this->choices = collect($this->choices)->shuffle();
        foreach ($ans as $a){
            $this->correctChoices[] = $this->choices->search($a);
        }
        $this->choices = $this->choices->toArray();
        return $this;
    }
}
