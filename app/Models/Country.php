<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'country';
    protected $primaryKey = "id";
    //  protected $fillable = ['country_name'];

    public function states()
    {
        return $this->hasMany(State::class);
    }

    public static function getAllCountries(){
        return self::all();
    }
}
