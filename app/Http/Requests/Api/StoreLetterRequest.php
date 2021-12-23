<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreLetterRequest extends FormRequest
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
            'subject' => ['required', 'string', 'min:2', 'max:100'],
            'body' => ['required', 'string', 'min:2', 'max:1500'],
        ];
    }

    /**
     * @return array
     */
    public function validated(): array
    {
        $data = parent::validated();
        $data['user_id'] = auth()->id();
        return $data;
    }
}
