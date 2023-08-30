<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class register_request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [

                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:workers',
                'password' => 'required|string|min:6',
                'photo' => 'required|image|mimes:jpg,bmp,png',
                'phone'=>'string|required',
                'location'=>'string|required',

        ];
    }
}
