<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new \App\User;
        $admin->username ="admin";
        $admin->name ="admin";
        $admin->email ="admin@gmail.com";
        $admin->roles = json_encode(["1"]);
        $admin->password = \Hash::make("admin");
        $admin->avatar ="blmada.png";
        $admin->alamat ="Jalan Babarsari , Yogyakarta";
        $admin->telp ="081232467232";
        $admin->status ="1";

        $admin->save();

        $this->command->info("Berhasil insert");
    }
}
