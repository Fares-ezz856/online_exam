<?php

namespace App\Http\Controllers;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\OptionRequest;
use App\Models\Question;

class OptionController extends Controller
{
    use ApiResponse;
    public function create(OptionRequest $optionRequest,Question $question){
        $validated=$optionRequest->validated();
        if($validated['is_correct']){
            $hascorrect=$question->options()->where('is_correct',true)->exists();
            if($hascorrect){
                return $this->error("You Can't add new true");
            }

        }
         $question->options()->create($validated);
            return $this->success('Options added successfully');
    }
}
