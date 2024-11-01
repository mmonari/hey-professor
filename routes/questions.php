<?php
// Questions Routes
use App\Http\Controllers\Question;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::prefix('/question')->name('question.')->group(function () {

        Route::get('/', Question\IndexController::class)->name('index');
        Route::post('/store', Question\StoreController::class)->name('store');
        Route::post('/like/{question}', Question\LikeController::class)->name('like');
        Route::delete('/destroy/{question}', Question\DestroyController::class)->name('destroy');
        Route::post('/dislike/{question}', Question\DislikeController::class)->name('dislike');
        Route::put('/publish/{question}', Question\PublishController::class)->name('publish');
        Route::put('/unpublish/{question}', Question\UnpublishController::class)->name('unpublish');

    });

});
