<?php

namespace App\Http\Requests\Posing;

use Illuminate\Foundation\Http\FormRequest;

class MakePosting extends FormRequest
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
            'payment_ids' => 'required|array',
        ];
    }
}
