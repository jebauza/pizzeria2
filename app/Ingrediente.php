<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    public function pizzas(){
        return $this->belongsToMany('App/Pizza','ingrediente_pizza','ingrediente_id','pizza_id');
    }
}
