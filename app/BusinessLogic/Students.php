<?php

namespace App\BusinessLogic;

use App\Models\Curriculum;
use App\Models\Student;
use Exception;

class Students
{
    //Вывод всех студентов
    public static function all_students(){
       try{
            $all_students = Student::select(['id','name','email','school_class_id'])->orderBy('id','ASC')->get();
            return json_encode($all_students);
        }catch(Exception $e){
            echo "Ошибка: " . $e->getMessage();
        }
    }
    //Метод добавление данных в форму Front
    /*public static function create_student(){
        return true;
    }*/

    //Сохранение нового студента
    public static function store_student($request){
        try{
            return Student::query()->create([
                'name' => $request->name,
                'email' => $request->email,
                'school_class_id' => $request->school_class_id
            ]);
        }catch(Exception $e){
            echo "Ошибка: " . $e->getMessage();
        }
    }

    //Вывод конкретного студента с данными класса и лекций
    public static function show_student(int $id){
        $check = Student::find($id);
        //проверка существования студента
        if($check) {
            try {
                $show_student = [];
                $query_student = Student::find($id)->with('school_class')->where('id', $id)->first();
                $show_student['name'] = $query_student->name;
                $show_student['email'] = $query_student->email;
                $show_student['class'] = $query_student->school_class->name;

                $query_plan = Curriculum::where('school_class_id', $query_student->school_class->id)->with('lectures')->first();

                if ($query_plan !== null) {
                    if ($query_plan->lectures !== null) {
                        $show_student['lectures'] = [];
                        foreach ($query_plan->lectures as $value) {
                            $show_student['lectures'][] = $value->theme;
                        }
                    }
                } else {
                    $show_student['lectures'] = 'Not lectures !';
                }
                return json_encode($show_student);

            } catch (Exception $e) {
                echo "Ошибка: " . $e->getMessage();
            }
        }
    }

    //Обновление студента
    public static function update_student(int $id, $request){

        try{
            $update_student = Student::find($id);
            if($request->name !== null){
                $update_student->name = $request->name;
            }
            if($request->school_class_id !== null){
                $update_student->school_class_id = (int)$request->school_class_id;
            }
            $update_student->save();
            return json_encode($update_student);

        }catch(Exception $e){
            echo "Ошибка: " . $e->getMessage();
        }
    }

    //Удаление студента
    public static function delete_student(int $id){
        try{
            return Student::find($id)->delete();

        }catch(Exception $e){
            echo "Ошибка: " . $e->getMessage();
        }
    }
}
