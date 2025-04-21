<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $table = 'school';  // Make sure this matches your table name
    protected $primaryKey = "id";
    // protected $fillable = [
    //     'school_name',
    // ];
    public static function getAllSchools(){
        return self::all();
    }
}
