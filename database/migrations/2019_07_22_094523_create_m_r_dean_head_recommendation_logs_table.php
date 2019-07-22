<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMRDeanHeadRecommendationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mr_dean_head_recommendation_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dean_head_rec_id');
            $table->foreign('dean_head_rec_id')->references('id')->on('mr_dean_head_recommendations');
            $table->unsignedTinyInteger('status')->default(0);// 0 = notify, 1 = complate with recomended, 2 = completed with not recommended, 3 = auto approved 
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
        Schema::dropIfExists('mr_dean_head_recommendation_logs');
    }
}
