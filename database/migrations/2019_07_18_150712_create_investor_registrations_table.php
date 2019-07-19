<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestorRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investor_registrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_registered_name');
            $table->string('business_registered_no');
            $table->string('paid_up_capital');
            $table->string('company_website');
            $table->string('contact_person_name');
            $table->string('contact_person_position');
            $table->string('tel_no');
            $table->string('fax_no');
            $table->string('hp_no');
            $table->string('email');
            $table->text('business_classification');
            $table->text('business_description');
            $table->text('area_of_intereseted');
            $table->boolean('isJoinPanel');
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
        Schema::dropIfExists('investor_registrations');
    }
}
