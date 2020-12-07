<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Contract extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'property' => 'required',
            'owner' => 'required',
            'customer' => 'required',
            'rent_price' => 'required',
            'adm_fee' => 'required',
            'tribute' => 'required',
            'condominium' => 'required',
            'start_at' => 'required',
            'end_at' => 'required'
        ];
    }
}
