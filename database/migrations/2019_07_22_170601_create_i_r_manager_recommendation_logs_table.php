<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIRManagerRecommendationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ir_manager_recommendation_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('manager_rec_id');
            $table->foreign('manager_rec_id')->references('id')->on('ir_manager_recommendations');
            $table->unsignedTinyInteger('status')->default(0);// 0 = notified, 1 = completed with approved, 2 = completed with rejected 
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
        Schema::dropIfExists('ir_manager_recommendation_logs');
    }
}
