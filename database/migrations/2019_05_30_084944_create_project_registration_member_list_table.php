<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectRegistrationMemberListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_member_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_registration_id');
            $table->foreign('project_registration_id')->references('id')->on('project_registrations');
            $table->unsignedBigInteger('project_member_id');
            $table->foreign('project_member_id')->references('id')->on('project_members');
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
        Schema::dropIfExists('project_registration_member_list');
    }
}
