<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_penjualans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_number');
            $table->float('total')->unsigned()->defaults(0);
            $table->text('alamat_pengiriman');
            $table->string('no_resi');
            $table->enum('status', ['WAITING','SUBMIT','PROCESS','SENDING','FINISH','CANCEL']);
            $table->integer('karyawan_id')->unsigned();
            $table->integer('pembeli_id')->unsigned();
            $table->timestamps();
            $table->foreign('pembeli_id')->references('id')->on('pembelis');
            $table->foreign('karyawan_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tr_penjualans', function(Blueprint $table){
            $table->dropForeign('tr_penjualans_pembeli_id_foreign');
            $table->dropForeign('tr_penjualans_karyawan_id_foreign');
        });

        Schema::dropIfExists('tr_penjualans');
    }
}
