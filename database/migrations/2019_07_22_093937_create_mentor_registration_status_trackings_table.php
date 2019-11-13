<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMentorRegistrationStatusTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mr_status_trackings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mentor_regis_id');
            $table->foreign('mentor_regis_id')->references('id')->on('mentor_registrations');
            $table->unsignedTinyInteger('mentor_registration_status');
            $table->timestamps();
            /**
             * 0 = submited
             * 1 = supervisor recommendation
             * 2 = dean/head recommendation
             * 3 = manager recommendation
             * 4 = director approval
             * 5 = approved
             * 6 = rejected
             */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mr_status_trackings');
    }
}
