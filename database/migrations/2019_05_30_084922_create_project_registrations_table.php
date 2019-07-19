<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_registrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('project_title');
            $table->text('problem_statement');
            $table->text('product_solution');
            $table->text('target_market');
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
        Schema::dropIfExists('project_registrations');
    }
}
