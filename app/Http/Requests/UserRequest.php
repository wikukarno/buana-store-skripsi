<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'string',
            'roles' => 'string',
            'email' => 'string',   
            'photo_profile' => 'string',    
            'name_store' => 'string',   
            'phone' => 'integer',    
            'photo_shop' => 'string',
            'name_bank' => 'string',
            'account_number' => 'string',
            'village' => 'string',  
            'street' => 'string',  
            'address' => 'string',  
            'status' => 'string', 
            'reg_status' => 'string', 
            'provinces_id' => 'integer',
            'regencies_id' => 'integer',
            'districts_id' => 'integer',
        ];
    }
}
