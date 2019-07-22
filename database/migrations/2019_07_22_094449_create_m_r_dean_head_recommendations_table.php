<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMRDeanHeadRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mr_dean_head_recommendations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('recommended_by');
            $table->foreign('recommended_by')->references('id')->on('dean_heads');
            $table->boolean('is_recommended')->nullable();
            $table->text('reason')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('status_tracking_id');
            $table->foreign('status_tracking_id')->references('id')->on('mr_status_trackings');
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
        Schema::dropIfExists('mr_dean_head_recommendations');
    }
}
