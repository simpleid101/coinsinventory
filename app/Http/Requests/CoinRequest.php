<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoinRequest extends FormRequest
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
            //
            'field_#' => 'required',
            'bag_#' => 'required',
            'mint' => 'required',
            'mintmark' => 'required',
            'weight' => 'required',
            'diameter' => 'required',
            'date' => 'required',
            'square' => 'required',
            'location' => 'required',
            'emission' => 'required',
            'obverse_photo' => 'file|image',
            'reverse_photo' => 'file|image'
        ];
    }

    public function setFields( )
    {

    }

    public function savePhoto() 
    { 

    }

    public function replacePhoto() {

    }
}
