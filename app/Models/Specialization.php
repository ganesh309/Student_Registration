<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;
    protected $table="specialization";
    protected $primaryKey= "id";

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public static function getAllSpecialization($course_id){
        return self::where("course_id", $course_id)->get();
    }
}
