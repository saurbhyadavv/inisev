<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'website_id' => 'required|exists:websites,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ];
    }
};
