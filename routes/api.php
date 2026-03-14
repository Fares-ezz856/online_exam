<?php

use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register',[AuthUserController::class,'register']);
Route::post('login',[AuthUserController::class,'login']);
Route::post('logout',[AuthUserController::class,'logout'])->middleware('auth:user');

Route::post('admin/register',[AuthAdminController::class,'register']);
Route::post('admin/login',[AuthAdminController::class,'login']);
Route::post('admin/logout',[AuthAdminController::class,'logout'])->middleware('auth:admin');

Route::prefix('exams')->controller(ExamController::class)->middleware('auth:user,admin')->group(function(){
    Route::get('all','index');
    Route::post('create','create');

});

Route::prefix('questions')->controller(QuestionController::class)->middleware('auth:admin')->group(function(){
    Route::post('create','create');

});

Route::prefix('options')->controller(OptionController::class)->middleware('auth:admin')->group(function(){
    Route::post('create/{question}','create');

});
