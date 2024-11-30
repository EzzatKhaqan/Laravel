<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicineRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'medicine_name'=>'required|string',
            'desc'=>'required|string|max:255',
            'exp_date'=>'required|date',
            'unt_price'=>'required|numeric',
            'qnt'=>'required|numeric',
        ];
    }
}
