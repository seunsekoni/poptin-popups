<?php

namespace App\Http\Requests\User\Popup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePopupRequest extends FormRequest
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
        return [
            'text' => [
                Rule::unique('popups', 'text')
                    ->where('domain_id', $this->domain->id)
                    ->ignoreModel($this->popup)
            ],
            'form' => 'array',
            'form.*.page' => [
                'required',
                'string',
                // 'distinct',
            ],
            'form.*.text' => 'string',
            'form.*.rule' => 'string',
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
            'page.required' => 'Please enter a page name.',
            'page.string' => 'Please enter a valid page name.',
            'page.distinct' => 'This page name is already in use.',
            'page.unique' => 'This page name is already in use.',
            'text.required' => 'Please enter a text.',
            'rule.required' => 'Please enter a rule.',
        ];
    }
}
