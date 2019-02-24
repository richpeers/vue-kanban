<?php

namespace App\Http\Requests\Columns;

use Illuminate\Foundation\Http\FormRequest;

class CreateColumnFormRequest extends FormRequest
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
            'order' => 'required|integer',
            'title' => 'required|string',
            'board_id' => 'required|integer|exists,boards,id',
        ];
    }
}
