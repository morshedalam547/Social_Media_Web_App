<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Only logged in user can comment
        return auth()->check();
    }

    public function rules(): array
    {
        return [
  
            'content' => ['required', 'string', 'max:1000'],
            
        ];
    }


}
