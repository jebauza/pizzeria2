<?php

use App\Rol;
use Illuminate\Database\Seeder;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles=['administrador','chef','user'];
        foreach($roles as $rol)
        {
            Rol::create(['nombre'=>$rol]);
        }
    }
}
