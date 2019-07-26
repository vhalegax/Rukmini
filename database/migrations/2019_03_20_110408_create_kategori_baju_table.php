<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKategoriBajuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_baju', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('baju_id')->unsigned()->nullable();
                $table->integer('kategori_id')->unsigned()->nullable();
                $table->timestamps();
    
                $table->foreign('baju_id')->references('id')->on('bajus');
                $table->foreign('kategori_id')->references('id')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_baju');
    }
}
