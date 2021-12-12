<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MeetingUpdateRequest extends FormRequest
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
            'dateBs' => 'present',
            'time' => 'required',
            'venue' => 'required',
            'subject' => 'required',
            'proposal.*' => 'required',
            'detail.*' => 'required'
        ];
    }
}
