<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessedRequest extends FormRequest
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
        $rules = [
            'client_id' => 'required',
            'date' => 'required',
            'quantity' => 'required|min:0.1',
            'kg' => 'required|min:0.1',
            'price' => 'required|min:0.1',
            'amount' => 'required|min:0.1',
            'chickens' => 'min:1',
            'boxes' => 'min:1',
            'credit' => 'required',
        ];

        return $rules;
    }
}
