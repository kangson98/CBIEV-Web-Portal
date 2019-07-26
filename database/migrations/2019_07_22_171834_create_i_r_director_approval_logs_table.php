<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIRDirectorApprovalLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ir_director_approval_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('director_app_id');
            $table->foreign('director_app_id')->references('id')->on('ir_director_approvals');
            $table->unsignedTinyInteger('status')->default(0);// 0 = notify, 1 = complate with approved, 2 = completed with rejected
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
        Schema::dropIfExists('ir_director_approval_logs');
    }
}
