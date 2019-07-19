<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternalMentorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_mentor_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mentor_registration_id');
            $table->foreign('mentor_registration_id')->references('id')->on('mentor_registrations');
            $table->unsignedTinyInteger('center_faculty_id')->nullable();
            $table->foreign('center_faculty_id')->references('id')->on('center_faculties');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internal_mentor_details');
    }
}
