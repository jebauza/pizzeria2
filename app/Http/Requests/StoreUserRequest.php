<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required', 
            'email'=>'required|email|unique:users',
            'rol_id'=>'required|exists:rols,id',
            'password'=>array('required'),
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'El nombre es requerido',

            'email.required'=>'El email es requerido',
            'email.email'=>'El email no es valido',
            'email.unique'=>'El email proporcionado ya esta en uso',

            'rol_id.required'=>'El rol es requerido',
            'rol_id.exists'=>'El rol no es valido',

            'password.required'=>'El password es requerido',
        ];
    }

    /*public function attributes()
    {
        return [
           
        ];
    }*/
}
