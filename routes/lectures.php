<?php

use App\Http\Controllers\LectureController;
use Illuminate\Support\Facades\Route;

Route::prefix('lectures')->group(function(){
    Route::controller(LectureController::class)->group(function(){
        Route::get('/','allLecture')->name('lectures.index');
        /*Route::get('/create','createLecture')->name('lectures.create');*/
        Route::post('/storeLecture','storeLecture')->name('lectures.store');
        Route::get('/{id}/showLecture','showLecture')->name('lectures.show');
        /*Route::get('/{id}/editLecture','editLecture')->name('lectures.edit');*/
        Route::post('/{id}','updateLecture')->name('lectures.update');
        Route::get('/{id}/deleteLecture','deleteLecture')->name('lectures.delete');
    });
});
