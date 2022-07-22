<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $email = 'required|max:191|unique:users,email,0,status|email';
        $password = 'required|confirmed|min:8';
        if($this->id){
            $email = 'required|max:191|unique:users,email,'.$this->id.',id,status,1|email';
            $password = 'nullable|confirmed|min:8';
        }

        return [
            'name' => 'required|max:191',
            'surname' => 'required|max:191',
            'email' => $email,
            'role_id' => 'required|integer|exists:roles,id,status,1',
            'password' => $password,
        ];
    }
}
