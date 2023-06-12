<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class intervention_request extends FormRequest
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
            'ppr' => 'required',
            'intitule_intervention' => 'required',
            'annee_univ' => 'required',
            'semestre' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required',
            'nbr_heures' => 'required',
        ];
    }
}
