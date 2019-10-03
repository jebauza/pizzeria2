<?php

use App\Ingrediente;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class IngredientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Ingrediente::class,50)->create();
    }
}
