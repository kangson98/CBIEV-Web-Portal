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

            $table->text('business_classification');
            $table->text('business_description');
            $table->text('area_of_intereseted');
            $table->boolean('is_join_panel');
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
