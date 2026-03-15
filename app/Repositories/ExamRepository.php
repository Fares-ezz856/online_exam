<?php
namespace App\Repositories;

use App\Interfaces\ExamInterface;
use App\Models\Exam;

class ExamRepository implements ExamInterface{

    public function all()
    {
        $exams=Exam::with('questions.options')->get();
        return $exams;
    }

      public function create(array $data){
        Exam::create($data);
    }

    public function delete($id){
        $exam=Exam::find($id);
        $exam->delete();
    }
}
