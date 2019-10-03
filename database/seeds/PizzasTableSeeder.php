<?php

use Illuminate\Database\Seeder;
use App\Pizza;
use Faker\Generator as Faker;

class PizzasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
       for ($i=0; $i < 10; $i++) { 
           $pizza = Pizza::create([
               'nombre'=>$faker->unique()->city,
               'imagen'=>$faker->unique()->url,
           ]);
           $valores = [];
           for ($x=0;$x<5;$x++) {
            $num_aleatorio = rand(1,50);
            $valores[]=$num_aleatorio;
           }
           $pizza->ingredientes()->sync($valores);
       }
    }
}
