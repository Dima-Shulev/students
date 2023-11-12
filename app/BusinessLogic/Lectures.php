<?php

namespace App\BusinessLogic;

use App\Models\Lecture;
use App\Models\SchoolClass;
use Exception;

class Lectures
{
    //Вывод всех лекций
    public static function all_lectures()
    {
        try {
            $all_lectures = Lecture::select('theme')->orderBy('theme', 'ASC')->get();

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
            Lecture::query()->create([
                'theme' => $request->theme,
                'description' => $request->description,
                'curriculum_id' => $request->curriculum_id
            ]);

        }catch(Exception $e){
            echo "Ошибка: " . $e->getMessage();
        }
    }

    //Показать конкретную лекцию, классы, студенты
    public static function show_lecture(int $id)
    {
        $check = $show_lecture = Lecture::find($id);

        //проверка существования такой лекции
        if($check) {
            try {
                //получение данных и запись в массив
                $show = [];

                //выборка с жадной загрузкой лекции и учебного плана
                $show_lecture = Lecture::find($id)->with('curriculum')->first();

                $show['theme'] = $show_lecture->theme;
                $show['description'] = $show_lecture->description;

                $number_class = $show_lecture->curriculum->school_class_id;

                //выборка с жадной загрузкой класса и студентов
                $show_class = SchoolClass::find($number_class)->with('students')->get();
                $show['students'] = [];

                foreach ($show_class as $item) {
                    $show['class'] = $item->name;
                    foreach ($item->students as $student) {
                        $show['students'][] = $student->name;
                    }
                }

                //Вывод в виде массива с преобразованием в JSON
                return json_encode($show);

            } catch (Exception $e) {
                echo "Ошибка: " . $e->getMessage();
            }
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
