<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateISparkProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_spark_projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('project_title');
            $table->text('project_description');
            $table->unsignedTinyInteger('category_id');
            $table->foreign('category_id')->references('id')->on('project_categories');
            $table->unsignedBigInteger('team_leader');
            $table->foreign('team_leader')->references('id')->on('project_members');
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
        Schema::dropIfExists('i_spark_projects');
    }
}
