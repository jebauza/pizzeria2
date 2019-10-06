<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Jorge Ernesto Bauza Becerra',
            'email' => 'jebauza1989@gmail.com',
            'password' => bcrypt('Voludo*44'),
            'rol_id' => 1,
            'remember_token' => Str::random(10),
            'api_token' => Str::random(80),
        ]);

        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => bcrypt('password'),
            'rol_id' => rand(1,3),
            'remember_token' => Str::random(10),
            'api_token' => Str::random(80),
        ]);
        factory(User::class,50)->create();
    }
}
