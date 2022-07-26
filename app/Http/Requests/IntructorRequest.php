<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IntructorRequest extends FormRequest
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
        // $email = 'required|max:191|email';
        $email = 'required|max:191|unique:instructores,email,0,status|email';
            if($this->id){
                $email = 'required|max:191|unique:instructores,email,'.$this->id.',id,status,1|email';
            }

        return [
            'name' => 'required',
            'surnameP' => 'required',
            'email' => $email,
        ];
    }
}
