<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestorRegistrationContactPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investor_registration_contact_people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('investor_regis_id');            
            $table->foreign('investor_regis_id')->references('id')->on('investor_registrations');
            $table->string('contact_person_name');
            $table->string('contact_person_position');
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
        Schema::dropIfExists('investor_registration_contact_people');
    }
}
