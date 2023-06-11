<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class adminrequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        // $allowedusertypes=[1,2];
        // $usertype=auth()->user()->type;
        // return in_array($usertype,$allowedusertypes);
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
'ppr'=>'required|string|min:8|unique:administrateurs,ppr',
'email' => 'required|string|max:30|unique:users,email',
'password'=>'required|string|min:8',
'type'=>'required|in:2,3',
'nom'=>'required',
'prenom'=>'required',
'id_etab'=>'required'
  ];
    }
}
