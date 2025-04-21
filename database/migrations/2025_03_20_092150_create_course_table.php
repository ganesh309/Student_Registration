<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_course_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTable extends Migration
{
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {
            $table->id();
            $table->string('course_name'); // Course name
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('course');
    }
}
