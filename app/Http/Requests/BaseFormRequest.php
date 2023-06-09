<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BaseFormRequest extends FormRequest
{

    // public function __construct(Request $request)
    // {
    //     parent::__construct();

    //     $this->request = $request;
    // }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $res = [
            'code' => 422, //code Error
            'message' => $validator->errors()->first() , //Massage Return in Response Data field
            'status'=> 'error',
            //'error' => $validator->errors()->first() //Validator Errors
        ];
        //return response()->json($res,200,JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        throw new HttpResponseException(response()->json($res
        , 422));
    }



}
