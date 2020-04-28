<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferDetailsRequest extends FormRequest
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
            'from' => 'required',
            'to' => 'required',
            'departial_time' => 'required',
            'arrival_time' => 'required',
            'ticket_number' => 'required|numeric',
            'transportation' => 'required',
        ];
    }
}
