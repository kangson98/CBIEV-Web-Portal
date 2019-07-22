<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestorRegistrationContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investor_registration_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('investor_regis_id');            
            $table->foreign('investor_regis_id')->references('id')->on('investor_registrations');
            $table->string('contact_type');// 1 = hp, 2 = tel, 3 = email, 4 = fax
            $table->string('contact_detail');
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
        Schema::dropIfExists('investor_registration_contacts');
    }
}
