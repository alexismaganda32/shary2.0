<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssistanceRequest extends FormRequest
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
            'instructor_id' => 'required|integer|exists:instructores,id',
            'hosts' => 'required|array|min:1',
            'hosts.*' => 'required|integer|exists:hosts,id',
            'curso_id' => 'required|integer|exists:cursos,id',
            'date' => 'required',
            'hour' => 'required',
        ];
    }
}
