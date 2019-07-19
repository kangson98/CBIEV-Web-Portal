<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMentorRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentor_registrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('category');// 1 for internal, 2 for external
            $table->string('name');
            $table->string('ic');
            $table->string('contact');
            $table->string('email');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->string('position')->nullable();
            $table->string('official_email')->nullable();
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
        Schema::dropIfExists('mentor_registrations');
    }
}
