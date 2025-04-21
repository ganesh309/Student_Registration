<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();  // Creates an auto-incrementing id column
            $table->string('school_name');  // A column to store the school name
            $table->timestamps();  // Optional, for created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('schools');
    }
};
