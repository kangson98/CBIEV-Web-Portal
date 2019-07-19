<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePRDirectorApprovalLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_director_approval_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pr_dir_rec_id');
            $table->foreign('pr_dir_rec_id')->references('id')->on('pr_director_approvals');
            $table->timestamp('completed_at');
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
        Schema::dropIfExists('pr_director_approval_logs');
    }
}
