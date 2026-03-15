<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;

class WebExamController extends Controller
{
    public function index()
    {
        $exams = Exam::withCount('questions')->get();
        return view('admin.exams.index', compact('exams'));
    }

    public function create()
    {
        return view('admin.exams.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:1', // minutes
        ]);

        Exam::create($validated);

        return redirect()->route('admin.exams.index')->with('success', 'Exam created successfully.');
    }

    public function show(Exam $exam)
    {
        $exam->load('questions.options');
        return view('admin.exams.show', compact('exam'));
    }

    public function storeQuestion(Request $request, Exam $exam)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string',
            'correct_option' => 'required|integer',
        ]);

        $question = $exam->questions()->create(['question' => $validated['title'], 'grade' => 1]);

        foreach ($validated['options'] as $index => $optionTitle) {
            $question->options()->create([
                'text_option' => $optionTitle,
                'is_correct' => ($index == $validated['correct_option'])
            ]);
        }

        return back()->with('success', 'Question added successfully.');
    }
    public function edit($questionid,Request $request){
        $question=Question::findOrFail($questionid);
          $validated = $request->validate([
            'title' => 'required|string',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string',
            'correct_option' => 'required|integer',
        ]);
        $question->update([
            'question'=>$validated['title'],
            'grade'=>1
        ]);

        foreach($validated['options'] as $index =>$optiontitle){
            $question->options()->update([
                'text_option'=>$optiontitle,
                'correct_option'=>($index == $validated['correct_option'])
            ]);
        }
    }
}
