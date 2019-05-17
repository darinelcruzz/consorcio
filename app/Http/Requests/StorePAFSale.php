<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePAFSale extends FormRequest
{
    function authorize()
    {
        return true;
    }

    function rules()
    {
        return [
            'client_id' => 'required',
            'date' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'kg' => 'required',
            'amount' => 'required',
            'credit' => 'sometimes|required',
            'series' => 'required',
        ];
    }
}
