<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    function authorize()
    {
        return true;
    }

    function rules()
    {
        return [
            'client_id' => 'sometimes|required',
            'start' => 'sometimes|required',
            'end' => 'sometimes|required',
            'product_id' => 'sometimes|required',
        ];
    }
}
