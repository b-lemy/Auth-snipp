<?php

namespace App\Http\Requests;

use App\Enums\CurrencyType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class RegisterRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'company' => 'required',
            'country' => 'required',
            'state' => 'required',
            'currency' => ['required', new Enum(currencyType::class)],
            'phone' => ' required|digits:10',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',

        ];
    }
}
