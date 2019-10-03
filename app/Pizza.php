<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Pizza extends Model
{
    protected $fillable = ['nombre','imagen'];

    protected $appends = ["precio","informacion"];


    public function getPrecioAttribute()
    {
        $precio = 0;
        foreach($this->ingredientes as $i)
        {
            $precio += $i->precio;
        }
        return $precio+($precio/2);
    }

    public function getInformacionAttribute()
    {
        $informacion = [];
        foreach($this->ingredientes as $i)
        {
            $informacion[]= $i->nombre;
        }
        return $informacion;
    }

    public function ingredientes(){

        return $this->belongsToMany('App\Ingrediente','ingrediente_pizza','pizza_id','ingrediente_id');
    }
}
