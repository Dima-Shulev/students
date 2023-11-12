<?php

namespace App\BusinessLogic;

use App\Models\SchoolClass;
use App\Models\Student;
use Exception;

class Classes
{
    //Вывод всех классов
    public static function all_classes(){
        try{
            $all_classes = SchoolClass::select(['id','name'])->orderBy('id','ASC')->get();
            return json_encode($all_classes);

        }catch(Exception $e){
            echo "Ошибка: " . $e->getMessage();
        }
    }

    //метод добавления данных в форму на Front
    /*public static function create_class(){
        return view('< шаблон >');
    }*/

    //Созание класа
    public static function store_class($request){
        try{
            return SchoolClass::query()->create([
                'name' => $request->name
            ]);
        }catch(Exception $e){
            echo "Ошибка: " . $e->getMessage();
        }
    }

    //Вывод класса и всех его студентов
    public static function show_class(int $id){
        $check = SchoolClass::find($id);
        //проверка существования такого класса
        if($check) {
            try {
                $show = [];
                //жадная загрузка
                $query_class = SchoolClass::find($id)->with('students')->first();
                $show['name'] = $query_class->name;
                $show['all_students'] = [];

                //вывод всех студентов в классе
                if ($query_class->students !== null) {
                    foreach ($query_class->students as $student) {
                        $show['all_students'][] = $student->name;
                    }
                } else {
                    $show['all_students'] = 'Not any student';
                }
                return json_encode($show);

            } catch (Exception $e) {
                echo "Ошибка: " . $e->getMessage();
            }
        }
    }

    //
    /*public static function edit_class(int $id){
         return view('< шаблон >',compact('id');
    }*/

    //Обновление класса
    public static function update_class(int $id,$request){
        try{
            $update_class = SchoolClass::find($id);
            $update_class->name = $request->name;
            $update_class->save();

            return json_encode($update_class);

        }catch(Exception $e){
            echo "Ошибка: " . $e->getMessage();
        }
    }

    //Удаление класса с первоначальным разрывом связей со студентами без их удаления (студенты удаленного клсасса имеют значание класса - null)
    public static function delete_class(int $id){
        $check = SchoolClass::find($id);
        //проверка существования такого класса
        if($check) {
            try {
                //жадная загрузка данных
                $query_class = SchoolClass::find($id)->with('students')->where('id', $id)->first();

                //проверка существование студентов в классе
                if (!$query_class->students->isEmpty()) {
                    foreach ($query_class->students as $clear_class) {
                        $change_student = Student::find($clear_class->id);
                        $change_student->school_class_id = null;
                        $change_student->save();
                    }
                }
                return SchoolClass::find($id)->delete();

            } catch (Exception $e) {
                echo "Ошибка: " . $e->getMessage();
            }
        }
    }
}
