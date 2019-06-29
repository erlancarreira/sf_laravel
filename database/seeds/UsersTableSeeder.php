<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'     => 'Erlan Carreira',
            'address'  => 'Rua Maceio, 1955',
            'district' => 'Henrique Jorge',
            'phone'    => '988877164',
            'email'    => 'erlancarreira@hotmail.com',
            'password' => bcrypt('123456'),
            'city_id'  => 1,
        ]);
    }
}
