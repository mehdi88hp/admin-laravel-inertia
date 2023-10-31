<?php

namespace App\Scaffolder\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string componentName
 * @property array fields
 */
class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'componentName' => [
                'required',
            ],
            'fields.*.required' => 'required',
            'fields.*.name' => 'required',
            'fields.*.fieldType' => 'required',
        ];
    }
}
