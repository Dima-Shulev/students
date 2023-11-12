<?php

use App\Http\Controllers\CurriculumController;
use Illuminate\Support\Facades\Route;

Route::prefix('curriculums')->group(function(){
    Route::controller(CurriculumController::class)->group(function(){
        Route::get('/','allCurriculums')->name('curriculums.index');
        /*Route::get('/create','createLecture')->name('lectures.create');*/
        Route::post('/storeCurriculum','storeCurriculum')->name('curriculums.store');
        Route::get('/{id}/showCurriculum','showCurriculum')->name('curriculums.show');
        /*Route::get('/{id}/editCurriculum','editCurriculum')->name('curriculums.edit');*/
        Route::post('/{id}','updateCurriculum')->name('curriculums.update');
        Route::get('/{id}/deleteCurriculum','deleteCurriculum')->name('curriculums.delete');
    });
});
