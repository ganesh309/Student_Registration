<?php
// app/Models/BasicInformation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'fathersname', 'mothersname', 'date_of_birth', 'gender'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
