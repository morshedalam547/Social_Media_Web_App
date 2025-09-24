<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ProfileImageUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
