<?php

namespace App\Http\Controllers\Web\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Attempt;
use Illuminate\Http\Request;

class WebStudentController extends Controller
{
    public function index()
    {
        $exams = Exam::withCount('questions')->get();
        return view('student.dashboard', compact('exams'));
    }

    public function showExam(Exam $exam)
    {
        $exam->load('questions.options');
        return view('student.exams.take', compact('exam'));
    }

    public function submitExam(Request $request, Exam $exam)
    {
        // Simple scoring logic
        $score = 0;
        $totalQuestions = $exam->questions->count();
        $answers = $request->input('answers', []);

        foreach ($exam->questions as $question) {
            $correctOption = $question->options()->where('is_correct', true)->first();
            if ($correctOption && isset($answers[$question->id]) && $answers[$question->id] == $correctOption->id) {
                $score++;
            }
        }

        $percentage = ($totalQuestions > 0) ? ($score / $totalQuestions) * 100 : 0;

        Attempt::create([
            'user_id' => auth()->id(),
            'exam_id' => $exam->id,
            'score' => $percentage,
            'completed_at' => now(),
        ]);

        return view('student.exams.result', [
            'exam' => $exam,
            'score' => $score,
            'total' => $totalQuestions,
            'percentage' => $percentage
        ]);
    }
}
