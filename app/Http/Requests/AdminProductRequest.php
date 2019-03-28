<?php

namespace Gas\Http\Requests;

use Gas\Http\Requests\Request;

class AdminProductRequest extends Request
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

            'name' => 'required|min:3',
            'description' => 'required|min:8',
            'unidade' => 'required|min:2|max:2',
            'sale_price' => 'required',
            'cost_price' => 'required',

        ];
    }
}
