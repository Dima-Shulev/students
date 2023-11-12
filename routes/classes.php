<?php

use App\Http\Controllers\ClassController;
use Illuminate\Support\Facades\Route;

Route::prefix('classes')->group(function(){
    Route::controller(ClassController::class)->group(function(){
        Route::get('/','allClasses')->name('classes.index');
        /*Route::get('/create','createClass')->name('classes.create');*/
        Route::post('/storeClass','storeClass')->name('classes.store');
        Route::get('/{id}/showClass','showClass')->name('classes.show');
        /*Route::get('/{id}/editClass','editClass')->name('classes.edit');*/
        Route::post('/{id}','updateClass')->name('classes.update');
        Route::get('/{id}/deleteClass','deleteClass')->name('classes.delete');
    });
});
