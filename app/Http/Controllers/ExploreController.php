<?php


namespace App\Http\Controllers;


use App\Models\Quiz;

class ExploreController extends Controller
{
    public function index()
    {
        return view('explore', [
           "quizzes" => Quiz::all()
        ]);
    }
}