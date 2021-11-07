<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Default admin user";
        $user->email = "admin@emmanuel-lampe.de";
        $user->password = Hash::make("serverlist");
        $user->save();
    }
}
