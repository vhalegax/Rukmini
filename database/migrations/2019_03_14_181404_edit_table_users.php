<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('roles');
            $table->string('telp');
            $table->text('alamat');
            $table->string('avatar');
            $table->string('status');
            $table->string('username')->unique();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("roles");
            $table->dropColumn("telp");
            $table->dropColumn("alamat");
            $table->dropColumn("avatar");
            $table->dropColumn("status");
            $table->dropColumn("username");
        });
    }
}
