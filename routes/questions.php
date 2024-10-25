<?php
// Questions Routes

use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::post('/question/store', [QuestionController::class, 'store'])->name('question.store');
