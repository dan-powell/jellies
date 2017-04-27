<?php

namespace DanPowell\Jellies\Http\Requests\Incursion;

use Illuminate\Foundation\Http\FormRequest;

class IncursionStoreRequest extends FormRequest
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
            'minions' => 'required'
        ];
    }
}
