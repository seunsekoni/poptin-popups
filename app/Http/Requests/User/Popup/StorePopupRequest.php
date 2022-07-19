<?php

namespace App\Http\Requests\User\Popup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePopupRequest extends FormRequest
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
                Rule::unique('popups', 'text')->where('domain_id', $this->domain->id)
            ],
            'form' => 'required|array',
            'form.*.page' => [
                'string',
                // 'distinct',
            ],
            'form.*.rule' => 'string',
        ];
    }
}
