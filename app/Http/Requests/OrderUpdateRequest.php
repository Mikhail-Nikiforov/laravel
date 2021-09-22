<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'customerName' => ['required', 'string', 'min:3', 'max:100'],
            'phone' => ['required', 'alpha_dash', 'min:11', 'max:22'],
            'email' => ['required', 'email:rfc,dns', 'min:5'],
            'description' => ['sometimes']
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле :attribute нужно заполнить!',
            'min' => 'Поле :attribute содержит недопустимое количество символов!',
            'max' => 'Поле :attribute содержит недопустимое количество символов!'
        ];
    }

    public function attributes(): array
    {
        return  [
            'customerName' => 'имя заказчика',
            'phone' => 'телефон',
            'email' => 'e-mail',
        ];
    }
}
