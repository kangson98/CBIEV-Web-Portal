<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMentorRegistrationChangeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentor_registration_change_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mentor_registration_id');
            $table->foreign('mentor_registration_id')->references('id')->on('mentor_registrations');
            $table->string('column_name');
            $table->string('old_value');
            $table->string('new_value');
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
        Schema::dropIfExists('mentor_registration_change_logs');
    }
}
