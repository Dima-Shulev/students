<?php

namespace App\Models;

use App\Trait\HasPlansAndLectures;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory, HasPlansAndLectures;

    protected $table = 'curriculums';
    protected $fillable = ['plan','school_class_id'];
    public $timestamps = false;

    public function school_class(){
        return $this->belongsTo('App\Models\SchoolClass');
    }
}
