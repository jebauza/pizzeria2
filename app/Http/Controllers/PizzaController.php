<?php

namespace App\Http\Controllers;

use App\Pizza;
use App\Ingrediente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $pizzas = Pizza::all();
       dd($pizzas[0]->attributesToArray());
       //return $pizzas->toJson();
       $json_resp = [];
       foreach($pizzas as $pizza)
       {
        $json_resp[]=$pizza->attributesToArray();
       }
       return csrf_field();
       return $json_resp;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'imagen' => 'required',
            'ingrediente'=>'requiered',
        ]);
        if ($validator->fails()){
            //dd($validator->errors());
            return response()->json($validator->errors()->all());
        }
        $imagen = "";
        if($request->file('imagen'))
        {
            $file = $request->file('image');
            $nombre = $file->getClientOriginalName();
            $path = Storage::disk('public')->put('imagen/pizzas',$file);
            $imagen = asset($path);
        }
        $pizza = Pizza::create($request->all());
        $pizza->fill(['imagen'=>imagen])->save();
        $arrIdInfredientes = explode(',',$request->input('ingredientes'));
        $pizza->ingredientes()->sync($arrIdInfredientes);
        return $pizza;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function show(Pizza $pizza)
    {
        $pizza = Pizza::find($pizza);
        return $pizza;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function edit(Pizza $pizza)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pizza $pizza)
    {
        $arrIdInfredientes = explode(',',$request->input('ingredientes'));
        $pizza->fill($request->all())->save();
        //$pizza->ingredientes()->detach();
        $pizza->ingredientes()->sync($arrIdInfredientes);
        return $pizza;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pizza $pizza)
    {
        $pizza->delete();
    }
}
