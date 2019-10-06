<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::all();
        $users = User::orderBy('id')->get();
        //return csrf_token();
        return $users;
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
        $rules = [
            'name'=>'required', 
            'email'=>'required|email|unique:users',
            'rol_id'=>'required|exists:rols,id',
            'password'=>array('required'),
        ];
        $messages = [
            'name.required'=>'El nombre es requerido',
            'email.required'=>'El email es requerido',
            'email.email'=>'El email no es valido',
            'email.unique'=>'El email proporcionado ya esta en uso',
            'rol_id.required'=>'El rol es requerido',
            'rol_id.exists'=>'El rol no es valido',
            'password.required'=>'El password es requerido',
        ];
        Validator::make($request->all(), $rules, $messages)->validate();
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        $user->remember_token = Str::random(10);
        $user->api_token = Str::random(80);
        $user->save();
        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
