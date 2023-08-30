<?php

namespace App\Http\Requests\worker;

use Illuminate\Foundation\Http\FormRequest;

class WorkerReview extends FormRequest
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
           "post_id"=>"required|exists:posts,id",
           "comment"=>"nullable|string",
           "rate"=>"required|integer|max:5",
        ];
    }
}
