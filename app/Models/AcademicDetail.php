<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'school_id', 'course_id', 'specialization_id', 'roll_no'
    ];

    

   
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function specialization()
    {
        return $this->belongsTo(Specialization::class); 
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
