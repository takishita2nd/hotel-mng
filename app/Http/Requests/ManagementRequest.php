<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagementRequest extends FormRequest
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
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|digits:11',
            'num' => 'required|numeric|digits_between:1,2',
            'room' => 'required|numeric',
            'days' => 'required|numeric|digits_between:1,4',
            'start_day' => 'required|date',
        ];
    }
}
