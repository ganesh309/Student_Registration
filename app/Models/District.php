<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $table= "district";
    protected $primaryKey = "id";

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public static function getAllDistricts($state_id){
        return self::where("state_id", $state_id)->get();
    }
}
