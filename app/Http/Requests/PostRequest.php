<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * Get the validation rules that send the custom error message.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
                'name.regex' => 'Please enter valid name.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|regex:/[a-zA-Z]/|max:255',
            'image' => 'required|image|max:2048',
        ];
    }
}
