<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidCreateAndUpdateLecture;
use App\BusinessLogic\Lectures;

class LectureController extends Controller
{
    public function allLecture(){
        return Lectures::all_lectures();
    }

    /*public function create(){
        return Lectures::create_lecture();
    }*/

    public function storeLecture(ValidCreateAndUpdateLecture $request){
        return Lectures::store_lecture($request);
    }

    public function showLecture(int $id){
        return Lectures::show_lecture($id);
    }

    /*public function editLecture($id){
        return Lectures::edit_lecture($id);
    }*/

    public function updateLecture(int $id,ValidCreateAndUpdateLecture $request){
        return Lectures::update_lecture($id, $request);
    }

    public function deleteLecture(int $id){
        return Lectures::delete_lecture($id);
    }
}
