<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'mobile' => 'required|min:10|max:10|unique:users,mobile,'.$this->uuid.',uuid',
            'email' => 'required|email|min:3|max:30|unique:users,email,'.$this->uuid.',uuid',
            'name' => 'required|min:3|max:30',
            'username' => 'required|min:5|max:30|unique:users,username,'.$this->uuid.',uuid',
            'password' => 'nullable|min:8|max:12',
            'gender' => 'required|in:m,f,o',
            'role' => 'required|array',
            'role.*'=> 'required|exists:roles,uuid',
            'active' => 'required',
            'dob' => 'nullable|date_format:d-m-Y',
            'blood_group' => 'nullable'
        ];
    }
}
