<?php

namespace App\Http\Requests\Cards;

use Illuminate\Foundation\Http\FormRequest;

class CreateCardFormRequest extends FormRequest
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
            'column_id' => 'required|integer|exists:columns,id',
            'order' => 'required|integer',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'due' => 'nullable|date_format:"Y-m-d H:i"',
        ];
    }
}
