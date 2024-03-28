<?php

namespace App\Http\Requests\Admin\ClientController;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaterialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'format' => 'required|string',
            'file' => 'required|file',
            'text' => 'nullable|string',
            'preview' => 'nullable|file',
            'video_link' => 'nullable|url'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Название" обязательно для заполнения',
            'name.string' => 'Поле "Название" должно быть строкой',
            'name.max' => 'Поле "Название" не должно превышать 255 символов',

            'category_id.required' => 'Поле "рубрика" обязательно для заполнения',
            'category_id.exists' => 'Указанная рубрика не существует',

            'format.required' => 'Поле "Формат" обязательно для заполнения',
            'format.string' => 'Поле "Формат" должно быть строкой',

            'file.required' => 'Поле "Файл" обязательно для заполнения',
            'file.file' => 'Поле "Файл" должно быть файлом',

            'text.string' => 'Поле "Текст" должно быть строкой',

            'preview.file' => 'Поле "Превью" должно быть файлом',

            'video_link.string' => 'Поле "Ссылка на видео" должно быть строкой',
        ];
    }
}
