<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMentorRegistrationExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentor_registration_experiences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mentor_regis_id');
            $table->foreign('mentor_regis_id')->references('id')->on('mentor_registrations');
            $table->boolean('mentor_has_exp');
            $table->text('mentor_exp_text');
            $table->text('mentor_exp_entrepreneuship');
            $table->boolean('mentoring');
            $table->string('how_hear_program');
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
        Schema::dropIfExists('mentor_registration_experiences');
    }
}
