<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCalendarRequest extends FormRequest
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
            'date' => 'required|date_format:d.m.y',
            'title' => 'required|string|min:5',
            'description' => 'nullable|string|min:10',
            'duration' => ['nullable', 'string', 'regex:/^([0-9]{2}\:[0-9]{2}\-[0-9]{2}\:[0-9]{2})$/'],
        ];
    }

    public function messages()
    {
        return [
            'date.date_format' => 'Please, input a correct date in format: 30.10.22',
            'duration.regex' => 'Duration must be in format: start time - end time, (hour:min): 00:00-00:00'
        ];
    }
}

