<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_specialization_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecializationTable extends Migration
{
    public function up()
    {
        Schema::create('specialization', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id'); // Foreign key to course table
            $table->string('specialization_name'); // Specialization name
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('course')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('specialization');
    }
}
