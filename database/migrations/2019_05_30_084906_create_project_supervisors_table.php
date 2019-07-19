<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectSupervisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_supervisors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('member_type');
            $table->string('name');
            $table->string('ic');
            $table->string('contact');
            $table->string('email');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('company_email')->nullable();
            $table->string('position')->nullable();
            $table->string('uc_id')->nullable();
            $table->unsignedTinyInteger('center_faculty_id')->nullable();
            $table->foreign('center_faculty_id')->references('id')->on('center_faculties');
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('project_supervisors');
    }
}
