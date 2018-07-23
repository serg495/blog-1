<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'title' => 'required|string|unique',
            'summary' => 'required|string',
            'body' => 'required|string',
            'thumbnail' => 'image',
        ];
    }
}
