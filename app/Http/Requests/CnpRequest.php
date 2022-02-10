<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CnpRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "product_id"            => "required|exists:products,id",
            "center_operation_id"   => "required|exists:center_operations,id",
            "gondola"               => "required",
            "body_gondola"          => "required",
            "faces"                 => "required",
            "level"                 => "required",
            "depth"                 => "required",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }
}