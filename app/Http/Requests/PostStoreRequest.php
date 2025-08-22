<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,gif',
        ];
    }
}
