<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $table = 'school_classes';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function curriculum(){
        return $this->hasOne('App\Models\Curriculum');
    }

    public function students(){
        return $this->hasMany('App\Models\Student');
    }

}
