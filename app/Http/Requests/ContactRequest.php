<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
          'name'=>'required',
          'e-mail'=>'required|email',
          'subject'=>'required|min:3|max:15',
          'message'=>'required|min:5|max:500'
          ];
    }

    public function messages()
    {

      return [
              'name.required'=>'Поле "Имя" не заполнено',
              'e-mail.required'=> 'Укажите E-mail',
              'subject.required'=>'Не введена тема сообщения',
              'subject.min'=>'Тема не может быть короче 3-х символов',
              'subject.max'=>'Тема не может быть длинее 15-ти символов',
              'message.required'=>'Текс сообщения - обязателен к заполнению'

            ];
      }
}
