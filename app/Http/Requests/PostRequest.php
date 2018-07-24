<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        if ($this->method() == 'POST') {
            return [
                'title' => 'required|string|unique:posts',
                'summary' => 'required|string',
                'body' => 'required|string',
                'thumbnail' => 'image',
            ];
        } elseif ($this->method() == 'PUT') {
            return [
                'summary' => 'required|string',
                'body' => 'required|string',
                'thumbnail' => 'image',
                'title' => [
                    'required',
                    'string',
                    Rule::unique('posts')->ignore($this->post->id),
                ],
            ];
        }
    }
}
