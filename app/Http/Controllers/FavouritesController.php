<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class FavouritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * favourite the question
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question)
    {
        $question->favourites()->attach(auth()->id());
        return back();
    }

    /**
     * unfavourite the question
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->favourites()->detach(auth()->id());
        return back();
    }
}
