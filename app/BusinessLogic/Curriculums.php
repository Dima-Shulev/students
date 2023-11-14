<?php

namespace App\BusinessLogic;

use App\Models\Curriculum;
use App\Models\Lecture;
use Exception;

class Curriculums
{
    //Вывод всех доступных учебных планов
    public static function all_curriculums()
    {
       try{
            $all_curriculums = Curriculum::select(['plan','school_class_id'])->get();
            return json_encode($all_curriculums);

        }catch(Exception $e){
            echo "Ошибка: " . $e->getMessage();
        }
    }

    //Метод для добавления значений в форме Front
    /*public static function create_curriculum()
    {
        return view('< шаблон >');
    }*/

    //Запись нового учебного плана
    public static function store_curriculum($request)
    {
        try{
           $create_plan = Curriculum::query()->create([
                'plan' => $request->plan,
                'school_class_id' => $request->school_class_id
            ]);

           return json_encode($create_plan);

        }catch(Exception $e){
            echo "Ошибка: " . $e->getMessage();
        }
    }

    //Вывод конкретного плана с классом и лекциями в нем
    public static function show_curriculum(int $id)
    {
     //Проверка существования такого плана
     $check_isset_curriculum = Curriculum::find($id);
        if($check_isset_curriculum){
            try{
                $show = [];

                //Использование жадной загрузки
                $query_curriculum = Curriculum::find($id)->with('school_class')->where('id',$id)->first();


                $show['plan'] = $query_curriculum->plan;
                $show['class'] = $query_curriculum->school_class->name;
                $show['all_lecture'] = [];

                //если есть лекции в плане то перебрать и добавить в массив

                if($query_curriculum->lectures !== null) {
                    foreach ($query_curriculum->lectures as $lecture) {
                        $show['all_lecture'][] = $lecture->theme;
                    }
                }
                //если нет лекций в плане
                if($query_curriculum->lectures->isEmpty()){
                    $show['all_lecture'] = 'Not any lecture';
                }

                //Вывод массива с парсингом в json
                return json_encode($show);

            }catch(Exception $e){
                echo "Ошибка: " . $e->getMessage();
            }
        }else{
          throw new Exception('Не существует такого плана.');
        }
    }
    // Метод для отправки изменений в форме Front
    /*public static function edit_curriculum($id)
    {
         return view('< шаблон >',compact('id'));
    }*/

    //Обновление и изменение плана и относящегося к ему класса
    public static function update_curriculum(int $id,$request)
    {
        try{
            $update_curriculum = Curriculum::find($id);
            $update_curriculum->plan = $request->plan;
            $update_curriculum->school_class_id = $request->school_class_id;
            $update_curriculum->save();
            return json_encode($update_curriculum);

        }catch(Exception $e){
            echo "Ошибка:" . $e->getMessage();
        }
    }

    // Удаление учебного плана
    public static function delete_curriculum(int $id)
    {
        $check = Curriculum::find($id);
        // проверка существования такого плана
        if($check) {
            try {
                //жадная загрузка данных
                $query_plan = Curriculum::find($id)->with('lectures')->where('id', $id)->first();

                //проверка существование лекций в классе
                if (!$query_plan->lectures->isEmpty()) {
                    foreach ($query_plan->lectures as $clear_plan) {
                        $change_lecture = Lecture::find($clear_plan->id);

                        //открепления лекции от плана для его удаления и установка статуса плана для лекции null
                        $change_lecture->curriculum_id = null;
                        $change_lecture->save();
                    }
                }
                return Curriculum::find($id)->delete();

            } catch (Exception $e) {
                echo "Ошибка:" . $e->getMessage();
            }
        }
    }
}
