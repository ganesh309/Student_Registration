<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = 'course';
    protected $primaryKey = "id";

    public function specializations()
    {
        return $this->hasMany(Specialization::class);
    }

    public static function getAllCourses(){
        return self::all();
    }

    
}
