<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransactionRequest extends FormRequest
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
            'description'=>'required|max:30',
            'destinationFirstname'=>'required|min:2|max:30',
            'destinationLastname'=>'required|min:2|max:30',
            'destinationNumber'=>'required|min:26|max:27',
            'paymentNumber'=>'required|max:30',
            'deposit'=>'required',
            'sourceFirstName'=>'required',
            'sourceLastName'=>'required',
        ];
    }
    // public function messages()
    // {
    //     return[
    //         'description.max'=>'شرح انتقال وجه (حداکثر ۳۰ کاراکتر)'
    //     ];
    // }
}
