<?php

namespace App\Models;

use App\Trait\HasPlansAndLectures;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory, HasPlansAndLectures ;

    protected $table = 'lectures';
    protected $fillable = ['theme','description'];
    public $timestamps = false;
}
