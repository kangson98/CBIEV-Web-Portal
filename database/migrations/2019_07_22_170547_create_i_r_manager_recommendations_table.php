<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIRManagerRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ir_manager_recommendations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('recommended_by');
            $table->foreign('recommended_by')->references('id')->on('cbiev_staff');
            $table->boolean('is_recommended')->nullable();
            $table->text('reason')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('status_tracking_id');
            $table->foreign('status_tracking_id')->references('id')->on('ir_status_trackings');
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
        Schema::dropIfExists('ir_manager_recommendations');
    }
}
