<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeesPaymentSchedule extends Model
{
    protected $fillable = [
        'fees_structure_id',
        'start_date',
        'end_date',
        'extended_date',
        'late_fine',
        'payment',
        'description'
    ];



public function paymentSchedules()
{
    return $this->hasMany(FeesPaymentSchedule::class, 'structure_id');
}


public function structure()
{
    return $this->belongsTo(FeesStructure::class, 'fees_structure_id');
}


}
