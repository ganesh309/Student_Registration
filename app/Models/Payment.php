<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment_table'; // If table name is not 'payments'

    protected $fillable = [
        'student_id',
        'fees_structure_id',
        'total_amount',
        'payment_date',
        'payment_receipt',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function feesStructure()
    {
        return $this->belongsTo(FeesStructure::class, 'fees_structure_id');
    }
}


