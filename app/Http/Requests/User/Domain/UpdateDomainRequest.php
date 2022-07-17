<?php

namespace App\Http\Requests\User\Domain;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDomainRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        return [
            'top_level' => [
                'required',
                // 'regex:' . $regex, // comment out this validation so test domains with port can be added
                Rule::unique('domains')->ignoreModel($this->domain),
            ],
            'description' => 'nullable',
        ];
    }

    /**
     * Messages for the validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'top_level.required' => 'Please enter a domain name.',
            'top_level.unique' => 'This domain name is already in use.',
            'top_level.regex' => 'Please enter a valid domain name.',
            'description.nullable' => 'Please enter a description.',
        ];
    }
}
