<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParticipantStoreRequest extends FormRequest
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
            "name_en" => "required|string",
            "name_bn" => "required|string",
            "email" => "nullable|email",
            "phone" => "required|string|min:11",
            "class" => "required",
            "dob" => "required|string",
            "inst_name" => "required|string",
            "inst_address" => "nullable|string",
            'serial_no' => 'nullable|integer',
            'event_id'=>'required|integer',
        ];
    }
}
