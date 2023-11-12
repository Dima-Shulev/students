<?php

namespace App\Http\Controllers;

use App\BusinessLogic\Curriculums;
use App\Http\Requests\ValidCreateAndUpdateCurriculum;

class CurriculumController extends Controller
{
    public function allCurriculums(){
        return Curriculums::all_curriculums();
    }

    /*public function createCurriculum(){
        return Curriculums::create_curriculum();
    }*/

    public function storeCurriculum(ValidCreateAndUpdateCurriculum $request){
        return Curriculums::store_curriculum($request);
    }

    public function showCurriculum(int $id){
        return Curriculums::show_curriculum($id);
    }

    /*public function editCurriculum($id){
        return Curriculums::edit_curriculum($id);
    }*/

    public function updateCurriculum(int $id,ValidCreateAndUpdateCurriculum $request){
        return Curriculums::update_curriculum($id,$request);
    }

    public function deleteCurriculum(int $id){
        return Curriculums::delete_curriculum($id);
    }
}
