<?php

namespace App\Trait;

trait HasPlansAndLectures {

    public function lectures(){
        return $this->belongsToMany('App\Models\Lecture');
    }

    public function curriculums(){
        return $this->belongsToMany('App\Models\Curriculum');
    }
}


