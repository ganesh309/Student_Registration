<?php
// app/Models/FeesStructure.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesStructure extends Model
{
    use HasFactory;
    protected $table = 'fees_structure';

    protected $fillable = ['total_amount', 'course_id', 'academic_id'];

    // Define relationships if needed, for example:
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function feesDetails()
    {
        return $this->hasMany(FeesDetail::class, 'fees_structure_id');
    }

}
