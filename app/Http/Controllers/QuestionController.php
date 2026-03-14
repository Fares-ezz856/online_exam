<?php

namespace App\Http\Controllers;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Models\Question;


class QuestionController extends Controller
{
    use ApiResponse;
   public function create(QuestionRequest $questionRequest){
    $valiadted=$questionRequest->validated();
    Question::create($valiadted);
    return $this->success('Question Put Successfully');
   }
}
