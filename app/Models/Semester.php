<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    protected $table = 'semesters'; 
    protected $primaryKey = 'id';  

   
    protected $fillable = ['semester_no', 'other_column']; 

   
    public static function getAllSemesters()
    {
        return self::all(); 
    }

  
    public function feesStructures()
    {
        return $this->hasMany(FeesStructure::class);
    }
}
