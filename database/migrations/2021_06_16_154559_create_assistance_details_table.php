<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssistanceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistance_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('assistance_id');
            $table->unsignedBigInteger('host_id');
            $table->timestamps();

            $table->foreign('assistance_id')->references('id')->on('assistances');
            $table->foreign('host_id')->references('id')->on('hosts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assistance_details');
    }
}
