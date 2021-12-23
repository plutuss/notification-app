<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SendNotificationRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'letter_id' => ['required', 'integer', 'exists:letters,id'],
            'contacts' => ['required', 'array', 'min:1'],
            'contacts.*' => ['required', 'integer', 'exists:contacts,id'],
        ];
    }
}
