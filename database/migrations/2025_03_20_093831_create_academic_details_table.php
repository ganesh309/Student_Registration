<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('academic_details', function (Blueprint $table) {
            $table->id();  // Creates an auto-incrementing id column
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('school_id');  // Foreign key column for schools table
            $table->unsignedBigInteger('course_id');  // Foreign key column for courses table
            $table->unsignedBigInteger('specialization_id');  // Foreign key column for specialization table
            $table->timestamps();  // Optional, for created_at and updated_at timestamps

            // Add foreign key constraint to school_id
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('school_id')->references('id')->on('schools')
                ->onDelete('restrict')  // Action on delete
                ->onUpdate('restrict');  // Action on update

            // Add other foreign key constraints (course_id, specialization_id, etc.)
        });
    }

    public function down()
    {
        Schema::dropIfExists('academic_details');
    }
}
