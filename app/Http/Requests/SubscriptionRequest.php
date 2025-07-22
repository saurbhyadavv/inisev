<?php

namespace App\Http\Requests;

use App\Models\Subscription;
use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'website_id' => 'required|exists:websites,id',
            'email' => 'required|email|max:255',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'This email is already subscribed to the website',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $exists = Subscription::where('website_id', $this->website_id)
                ->where('email', $this->email)
                ->exists();
                
            if ($exists) {
                $validator->errors()->add('email', 'This email is already subscribed to the website');
            }
        });
    }
}

?>