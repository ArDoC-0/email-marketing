<?php

namespace App\Http\Requests\Subscriber;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscriberRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return
            [
                'email' => [
                    'required',
                    'email',
                    Rule::unique('subscribers', 'email')->ignore($this->id),
                    // Rule::unique('subscribers', 'email')->ignore(request('subscriber'))
                ],

                'first_name' => [
                    'required',
                    'string'
                ],
                'last_name' => [
                    'nullable',
                    'sometimes',
                    'string'
                ],
                'tag_ids' => [
                    'nullable',
                    'sometimes',
                    'array'
                ],
                'form_id' => [
                    'nullable',
                    'sometimes',
                    'exists:forms,id'
                ]

            ];
    }
}
