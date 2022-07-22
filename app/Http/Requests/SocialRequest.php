<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialRequest extends FormRequest
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

        $name = 'required|max:191|unique:reason_socials,name,0,status';
        if($this->id) {
            $name = 'required|max:191|unique:reason_socials,name,'.$this->id.',id,status,1';
        }

        return [
            'name' => $name
        ];

    }
}
