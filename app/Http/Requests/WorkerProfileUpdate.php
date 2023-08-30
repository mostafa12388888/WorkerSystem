<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkerProfileUpdate extends FormRequest
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
           'name'=>"required|string|between:2,150",
           "email"=>"required|email|unique:workers,email,".$this->id,
           "password"=>"nullable|string|min:6",
           "phone"=>"required|string|max:20|unique:workers,phone,".$this->id,
           "photo"=>"nullable|image|mimes:jpg,png,jpeg",
           "location"=>"required|string|min:6"
        ];
    }
}
