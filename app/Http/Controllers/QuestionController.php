<?php

namespace App\Http\Controllers;

use Auth;
use App\Standard;
use App\Question;
use App\Form;
use App\Html;
use App\Comment;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Show list of questions
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('questions.index', [
            'questions' => Question::orderBy('created_at', 'desc')->paginate(10), // ... ->get() or ->paginate(N) or ->simplePaginate(N)
            'standards' => Standard::orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Show question
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::findOrFail($id);

        return view('questions.show', ['question' => $question]);
    }

    /**
     * Show form to create new question
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $standards = Standard::all();

        return view('questions.create', ['standards' => $standards]);
    }

    /**
     * Create a new question instance.
     *
     * @param  array $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Question title and body are required fields and 
        // body can be no longer than 1000 characters
        $this->validate($request, [
            'title' => 'required|max:50',
            'body' => 'required|max:1000',
            'standards' => 'required'
        ]);

        // Question is valid; store in database
        $question = new Question();
        $question->title = $request['title'];
        $question->body = $request['body'];
        $request->user()->questions()->save($question);
        
        // Add question-standard relationship to pivot table if any were chosen
        $question->standards()->sync($request->input('standards'));

        session()->flash('flash_message', 'Question successfully created!');

        return redirect()->route('questions.index');
    }

    /**
     * Show form to edit a question.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('questions.edit', [
            'question' => Question::findOrFail($id),
            'standards' => Standard::all()
        ]);
    }

    /**
     * Update question in database
     *
     * @param  integer $id
     * @param  array   $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        // Question title and body are required fields and 
        // body can be no longer than 1000 characters
        $this->validate($request, [
            'title' => 'required|max:50',
            'body' => 'required|max:1000',
            'standard_ids' => 'required'
        ]);
        // Question is valid; store in database
        $question = Question::find($id);
        $question->title = $request['title'];
        $question->body = $request['body'];
        $question->save();
        // Update question-standard relationships in pivot table
        $question->standards()->sync($request->input('standard_ids'));
        // Positive reinforcement
        session()->flash('flash_message', 'Question successfully updated!');
        // See ya!
        return redirect()->route('questions.show', ['question' => $question]);
    }

    /**
     * Delete a question from database.
     *
     * @param  integer $question_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($question_id)
    {
        $question = Question::find($question_id);
        
        if ( (Auth::user() != $question->user) && (!Auth::user()->admin) ) {
            return redirect()->back();
        }

        $question->delete();
        
        // Remove all question-standard relationship in pivot table
        $question->standards()->detach();
        
        session()->flash('flash_message', 'Question successfully deleted!');

        return redirect()->route('questions.index');
    }
}
