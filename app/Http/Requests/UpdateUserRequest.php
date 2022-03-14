<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            "name.title" => "required",
            "name.first" => "required",
            "name.last" => "required",
            "email" => ["required", Rule::unique('users')->ignore($this->route("user"))],
            "location" => "required",
            "phone" => "required",
            "gender" => "required",
        ];
    }

    public function messages()
    {
        return [
            "name.title.required" => "Name title field is required.",
            "name.first.required" => "First name field is required.",
            "name.last.required" => "Last name field is required.",
            "location.required" => "Address field is required.",
        ];
    }
}
