<?php

namespace DanPowell\Jellies\Http\Requests\Minion;

use Illuminate\Foundation\Http\FormRequest;

class MinionUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',

            'attack' => 'numeric|nullable',
            'defence' => 'numeric|nullable',
            'initiative' => 'numeric|nullable',
            'health' => 'numeric|nullable',
        ];
    }
}
