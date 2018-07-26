<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|unique:posts',
            'summary' => 'required|string',
            'body' => 'required|string',
            'thumbnail' => 'image',
        ];
    }
}
