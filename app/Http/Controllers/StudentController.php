<?php

namespace App\Http\Controllers;

use App\Interface\Crud;
use Illuminate\Http\Request;
use App\BusinessLogic\Students;
use App\Http\Requests\ValidCreateStudent;
use App\Http\Requests\ValidUpdateStudent;

class StudentController extends Controller
{
    public function allStudents(){
        return Students::all_students();
    }

    /*public function createStudent(){
        return Students::create_student();
    }*/

    public function storeStudent(ValidCreateStudent $request){
        return Students::store_student($request);
    }

    public function showStudent(int $id){
        return Students::show_student($id);
    }

    /*public function editStudent($id){
        return Students::edit_student($id);
    }*/

    public function updateStudent(int $id,ValidUpdateStudent $request){
        return Students::update_student($id, $request);
    }

    public function deleteStudent(int $id){
        return Students::delete_student($id);
    }
}
