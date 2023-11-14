<?php

namespace App\BusinessLogic;

use App\Models\CurriculumLecture;
use App\Models\Lecture;
use App\Models\SchoolClass;
use App\Models\Student;
use Exception;

class Lectures
{
    //Вывод всех лекций
    public static function all_lectures()
    {
        try {
            $all_lectures = Lecture::select(['theme','description'])->orderBy('theme', 'ASC')->get();
            return json_encode($all_lectures);

        }catch(Exception $e){
            echo "Ошибка: " . $e->getMessage();
        }
    }

    //Заполнение данных в форме на Front
    /*public static function create_lecture()
    {
       return view('< шаблон >');
    }*/

    // Создание новой лекции
    public static function store_lecture($request)
    {
        try {
              $create_lecture = Lecture::query()->create([
                    'theme' => $request->theme,
                    'description' => $request->description
              ]);

           return json_encode($create_lecture);

        }catch(Exception $e){
            echo "Ошибка: " . $e->getMessage();
        }
    }

    //Показать конкретную лекцию, классы, студенты
    public static function show_lecture(int $id)
    {
        $check = Lecture::find($id);
        //проверка существования такой лекции
        if($check) {
            try {
                //создание массива для данных
                $show = [];
                $get_date_and_time = date('Y-m-d H:i:s');

                //выборка с жадной загрузкой лекции
                $show_lecture = Lecture::find($id)->with('curriculums')->where('id', $id)->get();

                foreach ($show_lecture as $theme) {
                    $show['id'] = $theme->id;
                    $show['theme'] = $theme->theme;
                    $show['description'] = $theme->description;
                }
                $show['class'] = [];

                $query_schedules = CurriculumLecture::all()->where('lecture_id',$show['id'])->where('schedule','<',$get_date_and_time);
                //проверка прошла ли лекция по расписанию или еще будет
                if(!$query_schedules->isEmpty()) {

                    //получение id классов, которые относятся к лекции
                    foreach ($show_lecture as $id) {
                        foreach ($id->curriculums as $class) {
                            $query_class = SchoolClass::find((int)$class->school_class_id)->with('students')->where('id', $class->school_class_id)->get();

                            foreach ($query_class as $item) {
                                //получение всех студентов данного класса
                                $query_students = Student::select(['name', 'school_class_id'])->where('school_class_id', $item->id)->get();

                                //вывод всех классов относящихся к лекции
                                foreach ($query_class as $class) {
                                    $show['class'][$class->name] = [];

                                    //вывод всех студентов относящихся к лекции
                                    foreach ($query_students as $student) {
                                        $show['class'][$class->name][] = $student->name;
                                    }
                                }
                            }
                        }
                    }
                }else{
                    $show['class'] = ['Пока лекция не прошла не в одном классе! '];
                }
                return json_encode($show);

           } catch (Exception $e) {
                echo "Ошибка: " . $e->getMessage();
            }
        }else{
            throw new Exception('Ошибка. Такой лекции нет !');
        }
    }

    //метод отправки формы в Front
    /*public static function edit_lecture($id)
    {
        return view('< шаблон >',compact('id);
    }*/

    //Обновление лекции
    public static function update_lecture(int $id, $request)
    {
        try {
            $update_lecture = Lecture::find($id);
            $update_lecture->theme = $request->theme;
            $update_lecture->description = $request->description;
            $update_lecture->save();

            return json_encode($update_lecture);

        }catch(Exception $e){
            echo "Ошибка: " . $e->getMessage();
        }
    }

    //Удаление лекции
    public static function delete_lecture(int $id)
    {
        try {
            return Lecture::find($id)->delete();
        }catch(Exception $e){
            echo "Ошибка: " . $e->getMessage();
        }
    }
}
