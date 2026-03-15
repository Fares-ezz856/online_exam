<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Attempt;
use App\Models\User;

class WebAdminController extends Controller
{
    public function index()
    {
        $examsCount = Exam::count();
        $questionsCount = Question::count();
        $attemptsCount = Attempt::count();
        $studentsCount = User::count();

        $recentExams = Exam::withCount('questions')->latest()->take(5)->get();
        $recentAttempts = Attempt::with(['user', 'exam'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'examsCount',
            'questionsCount',
            'attemptsCount',
            'studentsCount',
            'recentExams',
            'recentAttempts'
        ));
    }

    public function attempts()
    {
        $attempts = Attempt::with(['user', 'exam'])->latest()->get();
        return view('admin.attempts.index', compact('attempts'));
    }

    public function update($questionid){
        $question=Question::with('options')->findOrFail($questionid);
        return view('admin.exams.update',compact('question'));
    }

    public function updateQuestion(\Illuminate\Http\Request $request, $questionid)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string',
            'correct_option' => 'required|integer',
        ]);

        $question = Question::findOrFail($questionid);
        $question->update(['question' => $validated['title']]);

        // Delete old options and create new ones (simplest way to update)
        $question->options()->delete();

        foreach ($validated['options'] as $index => $optionTitle) {
            $question->options()->create([
                'text_option' => $optionTitle,
                'is_correct' => ($index == $validated['correct_option'])
            ]);
        }

        return redirect()->route('admin.exams.show', $question->exam_id)->with('success', 'Question updated successfully.');
    }


}
