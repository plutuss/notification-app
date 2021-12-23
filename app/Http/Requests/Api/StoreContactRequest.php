<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'last_name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'string','email', 'min:2', 'max:100','unique:contacts'],
            'jobs' => ['nullable', 'string', 'min:2', 'max:150'],
            'address' => ['nullable', 'string', 'min:2', 'max:150'],
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
