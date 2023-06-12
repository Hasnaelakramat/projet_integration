<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class enseignantrequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'nom'=>'required',
            'prenom'=>'required',
            'date_nais'=>'required',
            'id_grade'=>'required'
        ];
    }
}
