<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectRegistrationSupervisorListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_supervisor_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_registration_id');
            $table->foreign('project_registration_id')->references('id')->on('project_registrations');
            $table->unsignedBigInteger('project_supervisor_id');
            $table->foreign('project_supervisor_id')->references('id')->on('project_supervisors');
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
        Schema::dropIfExists('project_registration_supervisor_list');
    }
}
