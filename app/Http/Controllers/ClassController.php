<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidCreateAndUpdateClass;
use App\BusinessLogic\Classes;

class ClassController extends Controller
{

    public function allClasses(){
        return Classes::all_classes();
    }

    /*public function createClass(){
        return Classes::create_class();
    }*/

    public function storeClass(ValidCreateAndUpdateClass $request){
        return Classes::store_class($request);
    }

    public function showClass($id){
        return Classes::show_class($id);
    }

    /*public function editClass($id){
        return Classes::edit_class($id);
    }*/

    public function updateClass($id,ValidCreateAndUpdateClass $request){
        return Classes::update_class($id,$request);
    }

    public function deleteClass($id){
        return Classes::delete_class($id);
    }
}
