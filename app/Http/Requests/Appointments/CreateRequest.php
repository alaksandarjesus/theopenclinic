<?php

namespace App\Http\Requests\Appointments;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'uuid' => 'nullable|exists:users,uuid',
            'name' => 'required_if:uuid,""|nullable|min:3|max:30',
            'email' => 'required_if:uuid,""|nullable|email',
            'mobile' => 'required_if:uuid,""|nullable|digits:10',
            'doctor' => 'required|exists:users,uuid',
            'datetime' => 'required|date_format:d-m-Y H:i:s',
            'dob' =>  'required|date_format:d-m-Y',
            'gender' => 'required|in:m,f,o',
            'blood_group' =>'required'
        ];
    }
}
