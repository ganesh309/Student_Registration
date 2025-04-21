<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_address_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id'); // Foreign key to students table
            $table->unsignedBigInteger('country_id'); // Foreign key to country table
            $table->unsignedBigInteger('state_id'); // Foreign key to state table
            $table->unsignedBigInteger('district_id'); // Foreign key to district table
            $table->string('pin_no');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('country')->onDelete('restrict');
            $table->foreign('state_id')->references('id')->on('state')->onDelete('restrict');
            $table->foreign('district_id')->references('id')->on('district')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('address');
    }
}
