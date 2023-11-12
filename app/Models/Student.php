<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $fillable = ['name','email','school_class_id'];
    public $timestamps = false;

    public function school_class(){
        return $this->belongsTo('App\Models\SchoolClass');
    }
}
