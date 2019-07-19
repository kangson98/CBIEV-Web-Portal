<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('line_1');
            $table->string('line_2');
            $table->string('city');
            $table->string('zip');
            $table->string('state');
            $table->timestamps();
            $table->unsignedBigInteger('investor_registration_id');
            $table->foreign('investor_registration_id')->references('id')->on('investor_registrations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
