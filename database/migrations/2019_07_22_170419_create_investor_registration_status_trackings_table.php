<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestorRegistrationStatusTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ir_status_trackings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('investor_regis_id');
            $table->foreign('investor_regis_id')->references('id')->on('investor_registrations');
            $table->unsignedTinyInteger('investor_registration_status');
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
        Schema::dropIfExists('ir_status_trackings');
    }
}
