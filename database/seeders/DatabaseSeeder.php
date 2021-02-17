<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $password = Hash::make('admin'); 
        DB::table('users')->insert(
            array(
                'email' => 'admin@gmail.com',
                'password' => $password,
				'firstname' => 'Tamil'
            )
        );

        DB::table('teams')->insert(
            array(
                'user_id' => 1,
                'name' => 'Admin-team',
                'personal_team' => 1,
            )
        );

    }
}
