<?php

namespace App\Http\Controllers;

use App\BusinessLogic\Schedules;
use App\Http\Requests\ValidScheduleLection;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function allSchedule(){
        return Schedules::all_schedules();
    }

    /*public function create(){
        return Shedules::create_shedule();
    }*/

    public function storeSchedule(ValidScheduleLection $request){
        return Schedules::store_schedule($request);
    }

    /*public function updateSchedule(int $id,ValidScheduleLection $request){
        return Schedules::update_schedule($id,$request);
    }*/
}
