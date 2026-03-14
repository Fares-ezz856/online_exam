<?php

namespace App\Http\Controllers;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExamRequest;
use App\Http\Resources\ExamResource;
use App\Models\Exam;


class ExamController extends Controller
{
    use ApiResponse;
    public function index(){
        $exams=Exam::with('questions.options')->get();
        if($exams->isEmpty()){
            return $this->error('Not Found Any Exams');
        }
        return $this->success('This is Exams',200,ExamResource::collection($exams));
    }

    public function create(ExamRequest $examRequest){
        $validated=$examRequest->validated();
        Exam::create($validated);
        return $this->success('exam put successfully');
    }
}
