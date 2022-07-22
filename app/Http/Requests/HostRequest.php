<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HostRequest extends FormRequest
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
        $email = 'required|max:191|unique:hosts,email,0,status|email';

        if($this->id){
            $email = 'required|max:191|unique:hosts,email,'.$this->id.',id,status,1|email';
        }
        

        return [
            'name' => 'required|max:191',
            'surnameP' => 'required|max:191',
            'surnameM' => 'nullable|max:191',
            'NC' => 'required|integer',
            'house' => 'required|integer',
            'mobile' => 'required|integer',
            'CE' => 'required|integer',
            'email' => $email,
            'reason_social_id' => 'required|integer|exists:reason_socials,id',
            'NSS' => 'required|max:10',
            'reason_social_id' => 'required|integer|exists:reason_socials,id',
            'department_id' => 'required|integer|exists:departments,id',
            'puesto_id' => 'required|integer|exists:puestos,id',
        ];
    }
}