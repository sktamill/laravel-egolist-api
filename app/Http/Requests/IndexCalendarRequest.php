<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexCalendarRequest extends FormRequest
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
            'date_start' => 'required|date_format:d.m.y',
            'date_end' => 'required|date_format:d.m.y',
        ];
    }

    public function messages()
    {
        return [
            'date_start.date_format' => 'Please, input a correct date in format: 30.10.22',
            'date_end.date_format' => 'Please, input a correct date in format: 30.10.22',
        ];
    }
}

