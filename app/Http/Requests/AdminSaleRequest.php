<?php

namespace Gas\Http\Requests;

use Gas\Http\Requests\Request;

class AdminSaleRequest extends Request
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
            'client_id' => 'required',
            'seller_id' => 'required',
            'branch_id' => 'required',
            'sale_date' => 'required',

            'amount' => 'required',
            'situation' => 'required',
        ];
    }
}
