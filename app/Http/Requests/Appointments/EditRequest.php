<?php

namespace App\Http\Requests\Appointments;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            'uuid' => 'required|exists:appointments,uuid',
            'doctor' => 'required|exists:users,uuid',
            'datetime' => 'required|date_format:d-m-Y H:i:s',
            'dob' =>  'required|date_format:d-m-Y',
            'gender' => 'required|in:m,f,o',
            'blood_group' =>'required'
        ];
    }
}
