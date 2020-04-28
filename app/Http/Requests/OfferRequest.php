<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OfferRequest extends FormRequest
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
        if(Auth::guard('agency')->check())
        {
            return [
                'name' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'rooms' => 'required|numeric',
                'status' => 'required',
                'agency_price' => 'required|numeric',
                'user_price' => 'required|numeric',
                'category' => 'required'
            ];

        }
        else
        {
            return [
                'agency_id' => 'required',
                'name' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'rooms' => 'required|numeric',
                'status' => 'required',
                'agency_price' => 'required|numeric',
                'user_price' => 'required|numeric',
                'category' => 'required'
            ];
        }
       
    }
}
