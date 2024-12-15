<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class UserRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function rules(): array
    {

        return [
            'age' => 'required|integer|min:1|decimal:0',
            'name' => 'required|string',
            'email' => 'required|unique:users|email',
        ];
    }

    public function messages()
    {
        return [
            'age.required' => 'Поле "Возраст" обязательно для заполнения',
            'age.integer' => 'Возраст обязательно должно быть цифрой',
            'age.min:1' => 'Возраст обязательно должно быть больше нуля',
            'age.decimal:0' => 'Возраст обязательно должно быть не дробным',
            'name.required' => 'Поле "Имя" обязательно для заполнения',
            'name.string' => 'Имя обязательно должно быть строкой',
            'email.required' => 'Поле "Email" обязательно для заполнения',
            'email.email' => 'Email обязательно должно быть email',
            'email.unique' => 'Email обязательно должно быть уникален',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = response()->json([
            'message' => 'Invalid data send',
            'details' =>$errors->messages(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
