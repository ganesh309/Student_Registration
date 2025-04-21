
<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_basic_information_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasicInformationTable extends Migration
{
    public function up()
    {
        Schema::create('basic_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id'); // Foreign key to students table
            $table->string('fathersname');
            $table->string('mothersname');
            $table->date('date_of_birth');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('basic_information');
    }
}
