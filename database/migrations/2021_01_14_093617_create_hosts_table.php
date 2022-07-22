<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('surnameP');
            $table->string('surnameM')->nullable();
            $table->integer('NC');
            $table->bigInteger('house');
            $table->bigInteger('mobile');
            $table->bigInteger('CE');
            $table->string('email');
            $table->unsignedBigInteger('reason_social_id');
            $table->string('NSS');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('puesto_id');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('reason_social_id')->references('id')->on('reason_socials');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('puesto_id')->references('id')->on('puestos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hosts');
    }
}
