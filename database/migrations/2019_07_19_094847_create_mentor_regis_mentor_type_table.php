<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMentorRegisMentorTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentor_regis_mentor_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mentor_regis_id');
            $table->foreign('mentor_regis_id')->references('id')->on('mentor_registrations');
            $table->unsignedBigInteger('mentor_type_id');
            $table->foreign('mentor_type_id')->references('id')->on('mentor_types');
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
        Schema::dropIfExists('mentor_regis_mentor_type');
    }
}
