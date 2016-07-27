<?php

namespace App\Http\Controllers;

use Auth;
use App\Standard;
use App\Question;
use App\Form;
use Image;
use File;
use App\Html;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CreateQuestionRequest;
use PDF;

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
            'questions' => Question::latest('created_at')->paginate(5), // ... ->get() or ->paginate(N) or ->simplePaginate(N)
            'standards' => Standard::orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Show question
     *
     * @param  Question $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
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
     * @param  CreateQuestionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateQuestionRequest $request)
    {
        //Question::create($request->all()); <-- This tries to save an array into a string field, 
        //                                       so I'll save in this more verbose way until I learn better.
        $question = new Question;
        $question->title = $request['title'];
        $question->body = $request['body'];
        $image = $request->file('image');
        $newfilename = time() . '.' . $image->getClientOriginalExtension();

        // fit width, retain aspect ratio
        Image::make($image)->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('/uploads/question_images/' . $newfilename));

        $question->image = $newfilename;
        $request->user()->questions()->save($question);

        // Save image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            Image::make($image)->encode('jpg', 100)->save(public_path('/uploads/question_images/' . $newfilename));
        }

        // Add question-standard relationship to pivot table if any were chosen
        $question->standards()->sync($request->input('standards'));

        session()->flash('flash_message', 'Question successfully created!');
        
        return redirect('questions');
    }

    /**
     * Show form to edit a question.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('questions.edit', [
            'question' => $question,
            'standards' => Standard::all()
        ]);
    }

    /**
     * Update question in database
     *
     * @param  Question $question
     * @param  array   $request
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question, Request $request)
    {
        // Question title and body are required fields and 
        // body can be no longer than 1000 characters
        $this->validate($request, [
            'title' => 'required|max:50',
            'body' => 'required|max:1000',
            'standard_ids' => 'required'
        ]);

        // Question is valid; store in database
        $question->title = $request['title'];
        $question->body = $request['body'];
        // Upload/Replace image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $newfilename = time() . '.' . $image->getClientOriginalExtension();

            // fit width, retain aspect ratio
            Image::make($image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/uploads/question_images/' . $newfilename));

            // Delete old image image
            if ($question->image != '') {
                File::delete(public_path('/uploads/question_images/' . $question->image));
            }

            $question->image = $newfilename;
        }
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
     * @param  Question $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        if ( (Auth::user() != $question->user) && (!Auth::user()->admin) ) {
            return redirect()->back();
        }

        $question->delete();
        
        // Remove all question-standard relationship in pivot table
        $question->standards()->detach();
        
        session()->flash('flash_message', 'Question successfully deleted!');

        return redirect()->route('questions.index');
    }

    /**
     * Delete image associated to a question.
     *
     * @param  Question $question
     * @return \Illuminate\Http\Response
     */
    public function deleteImage(Question $question)
    {
        if ( (Auth::user() != $question->user) && (!Auth::user()->admin) ) {
            return redirect()->back();
        }

        // Delete old image image
        if ($question->image != '') {
            File::delete(public_path('/uploads/question_images/' . $question->image));
            $question->image = '';
            $question->save();
        }
        
        session()->flash('flash_message', 'Image successfully deleted!');

        return redirect()->back();
    }

    public function makePDF(Question $question)
    {
        $pdf = \App::make('snappy.pdf.wrapper');
        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 1000);
        $pdf->loadHTML('
            <html><head></head>
            <body>
                <h1>'.$question->title.'</h1><hr /><br />'.$question->body.'
                
                <script type="text/x-mathjax-config">
                    MathJax.Hub.Config({
                        tex2jax: {inlineMath: [[\'$\',\'$\'], [\'\\(\',\'\\)\']]}
                    });
                </script>
                <script type="text/javascript" async src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-MML-AM_CHTML"></script>
                <script type="text/x-mathjax-config">
                    MathJax.Hub.Register.StartupHook("TeX Jax Ready",function () {
                        var TEX = MathJax.InputJax.TeX;
                        var PREFILTER = TEX.prefilterMath;
                        TEX.Augment({
                            prefilterMath: function (math,displaymode,script) {
                                math = "\\displaystyle{"+math+"}";
                                return PREFILTER.call(TEX,math,displaymode,script);
                            }
                        });
                    });
                </script>
            </body>
            </html>');
        return $pdf->inline();
    }

    public function showPrintable(Question $question)
    {
        return view('questions.showprintable', ['question' => $question]);
    }
}
