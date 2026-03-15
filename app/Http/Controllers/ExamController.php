<?php

namespace App\Http\Controllers;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExamRequest;
use App\Http\Resources\ExamResource;
use App\Interfaces\ExamInterface;

class ExamController extends Controller
{
    private $repository;

    public function  __construct(ExamInterface $examInterface)
    {
        $this->repository=$examInterface;
    }
    use ApiResponse;
    public function index(){
        $exams=$this->repository->all();
        if($exams->isEmpty()){
            return $this->error('Not Found Any Exams');
        }
        return $this->success('This is Exams',200,ExamResource::collection($exams));
    }

    public function create(ExamRequest $examRequest){
        $validated=$examRequest->validated();
        $this->repository->create($validated);
        return $this->success('exam put successfully');
    }

    public function delete($id){
        $this->repository->delete($id);
        return $this->success('Deleted Successfully');
    }
}
