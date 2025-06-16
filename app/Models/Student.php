<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone_no', 'current_course_id', 'current_specialization_id', 'address_id', 'academic_detail_id', 'basic_information_id',
        'registration_number', 'password', 'image', 'signature', 'otp'
    ];

    public function address()
    {
        return $this->hasOne(Address::class);
    }


    public function academicDetails()
    {
        return $this->hasMany(AcademicDetail::class);
    }

    public function basicInformation()
    {
        return $this->hasOne(BasicInformation::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function academicDetail()
    {
        return $this->belongsTo(AcademicDetail::class);
    }


    public function course()
{
    return $this->belongsTo(Course::class, 'course_id');
}

public function semester()
{
    return $this->belongsTo(Semester::class, 'semester_id');
}

public function academicYear()
{
    return $this->belongsTo(AcademicYear::class, 'academic_year_id');
}

    public function currentCourse()
    {
        return $this->belongsTo(Course::class, 'current_course_id');
    }

    public function currentSpecialization()
    {
        return $this->belongsTo(Specialization::class, 'current_specialization_id');
    }

}
