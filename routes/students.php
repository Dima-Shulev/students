<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::prefix('students')->group(function(){
    Route::controller(StudentController::class)->group(function(){
        Route::get('/','allStudents')->name('students.index');
        /*Route::get('/create','create')->name('students.create');*/
        Route::post('/storeStudent','storeStudent')->name('students.store');
        Route::get('/{id}/showStudent','showStudent')->name('students.show');
        /*Route::get('/{id}/editStudent','editStudent')->name('students.edit');*/
        Route::post('/{id}','updateStudent')->name('students.update');
        Route::get('/{id}/deleteStudent','deleteStudent')->name('students.delete');
    });
});
