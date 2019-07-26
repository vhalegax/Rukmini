<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlamatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alamats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_pembeli')->unsigned()->nullable();
            $table->string('jalan');
            $table->string('kec')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('kota');
            $table->string('kabupaten')->nullable();
            $table->string('provinsi');
            $table->timestamps();

            $table->foreign('id_pembeli')->references('id')->on('pembelis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alamats');
    }
}
