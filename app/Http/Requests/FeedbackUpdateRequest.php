<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackUpdateRequest extends FormRequest
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
            'customerName' => ['required', 'string', 'min:3', 'max:50'],
            'description' => ['required', 'min: 3']
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
            'customerName' => 'имя',
            'description' => 'отзыв',
        ];
    }
}
