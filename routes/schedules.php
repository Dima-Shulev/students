<?php

use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::prefix('schedules')->group(function(){
    Route::controller(ScheduleController::class)->group(function(){
        Route::get('/','allSchedule')->name('schedules.index');
        /*Route::get('/create','createSchedule')->name('schedules.create');*/
        Route::post('/storeSchedule','storeSchedule')->name('schedules.store');
        /*Route::get('/{id}/showSchedule','showSchedule')->name('schedules.show');*/
        /*Route::get('/{id}/editSchedule','editSchedule')->name('schedules.edit');*/
        /*Route::post('/{id}','updateSchedule')->name('schedules.update');*/
        /*Route::get('/{id}/deleteSchedule','deleteSchedule')->name('schedules.delete');*/
    });
});
