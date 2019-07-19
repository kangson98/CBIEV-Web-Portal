<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name');
            $table->string('company_reg_no');
            $table->timestamps();
        });

        Schema::table('project_supervisors', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies');
        });
        Schema::table('project_members', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
