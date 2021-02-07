<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class exprequest extends FormRequest
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

            'categoryname'=> '',
            'amount'=> 'required|max:25',
            'entrydate'=> 'required|max:25',
            
            'uid'=> 'required|max:25',
           'created_at',
           
        
        ];
    }
}
