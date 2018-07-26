<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'summary' => 'required|string',
            'body' => 'required|string',
            'title' => [
                'required',
                'string',
                Rule::unique('posts')->ignore($this->post->id),
            ],
        ];
    }
}
