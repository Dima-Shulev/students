<?php

namespace App\BusinessLogic;

use App\Models\Curriculum;
use App\Models\CurriculumLecture;
use Exception;

class Schedules {

    public static function all_schedules(){
        try{
            $all_schedules = CurriculumLecture::select(['curriculum_id','lecture_id','schedule'])->orderBy('curriculum_id','ASC')->get();
            return json_encode($all_schedules);

        }catch(Exception $e){
            echo "Ошибка: ". $e->getMessage();
        }
    }

    public static function store_schedule($request){
            //проверка существования лекциий в плане
            $check = CurriculumLecture::where('curriculum_id',(int) $request->curriculum_id)->where('lecture_id',(int) $request->lecture_id)->first();
            if(!$check){
                $save_relation = CurriculumLecture::create([
                    'curriculum_id' => $request->curriculum_id,
                    'lecture_id' => $request->lecture_id,
                    'schedule' => date('Y-m-d H:i:s',strtotime($request->schedule))
                ]);
                return json_encode($save_relation);
            }else{
                throw new Exception('Ошибка. Такая лекция в плане уже есть');
            }
    }

    /*public static function update_schedule(int $curriculum_id, $request){
        try{
            $update_relation = CurriculumLecture::find($curriculum_id);
            $update_relation->curriculum_id = $request->curriculum_id;
            $update_relation->lecture_id = $request->lecture_id;
            $update_relation->schedule = strtotime($request->schedule);
            $update_relation->save();
            return $update_relation;

        }catch(Exception $e){
            echo "Ошибка: ". $e->getMessage();
        }
    }*/
}
