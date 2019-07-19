<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestorAddressListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investor_address_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->unsignedBigInteger('investor__id');
            // $table->foreign('investor__id')->references('id')->on('ispark_investor');
            // $table->unsignedBigInteger('address_id');
            // $table->foreign('address_id')->references('id')->on('addresses');
            // $table->unsignedTinyInteger('addressType');// 1 for registered address, 2 for business address
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investor_address_list');
    }
}
