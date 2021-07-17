<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Get all resources in storage.
     *
     * @param Question $question
     * @return Response
     */
    public function index(Question $question)
    {
        return $question->answers()->with('user')->simplePaginate(3);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Question $question
     * @return Response
     */
    public function store(Question $question, Request $request)
    {
        $answer = $question->answers()->create(
            $request->validate(['body' => 'required']) + ['user_id' => Auth::id()]
        );

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Your answer has been submitted successfully.',
                'answer' => $answer->load('user')
            ]);
        }

        return back()->with('success', 'Your answer has been submitted successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Answer $answer
     * @return Response
     */
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        return view('answers.edit', compact(['question', 'answer']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Answer $answer
     * @return Response
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        $answer->update($request->validate(['body' => 'required']));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Your answer has been updated.',
                'body_html' => $answer->body_html,
            ]);
        }
        return redirect()->route('questions.show', $question->slug)->with('success', 'Your answer has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Answer $answer
     * @return Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize('delete', $answer);
        $answer->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'Your answer is removed successfully.',
            ]);
        }

        return back()->with('success', 'Your answer is removed successfully.');
    }
}
