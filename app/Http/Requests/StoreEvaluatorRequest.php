<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvaluatorRequest extends FormRequest
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
            'employee_id' => 'required|string|unique:evaluator,employee_id',
        ];
    }

    public function messages()
    {
        return [
            'employee_id.unique' => 'Tidak dapat ditambahkan data penilai telah tersedia'
        ];
    }
}
