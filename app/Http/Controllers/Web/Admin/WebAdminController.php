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

        return view('admin.dashboard', compact(
            'examsCount',
            'questionsCount',
            'attemptsCount',
            'studentsCount',
            'recentExams'
        ));
    }

    public function attempts()
    {
        $attempts = Attempt::with(['user', 'exam'])->latest()->get();
        return view('admin.attempts.index', compact('attempts'));
    }

    public function delete($questionid){
        $question=Question::findOrFail($questionid);
        $question->delete();
        return redirect()->back()->with('success','question deleted successfully');
    }

}
