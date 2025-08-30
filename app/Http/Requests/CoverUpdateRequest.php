<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CoverUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:40000',
        ];
    }
}
