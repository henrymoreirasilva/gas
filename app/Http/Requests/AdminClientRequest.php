<?php

namespace Gas\Http\Requests;

use Gas\Http\Requests\Request;

class AdminClientRequest extends Request
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
            'phone' => 'required|min:8',
            'email' => 'required|email',
            'address' => 'required|min:10',
            'address_number' => 'required|min:1',
            'city' => 'required|min:3',
            'state' => 'required|min:2|max:2',
        ];
    }
}
