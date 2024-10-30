<?php
// Questions Routes
use App\Http\Controllers\{Question, QuestionController};
use Illuminate\Support\Facades\Route;

Route::post('/question/store', [QuestionController::class, 'store'])->name('question.store');

Route::post('/question/like/{question}', Question\LikeController::class)->name('question.like');

Route::post('/question/dislike/{question}', Question\DislikeController::class)->name('question.dislike');

Route::put('/question/publish/{question}', Question\PublishController::class)->name('question.publish');
