<?php

namespace App\Http\Requests\Admin\ClientController;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaterialRequest extends FormRequest
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
            'name' => 'sometimes|required|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
            'format' => 'sometimes|required|string',
            'file' => 'sometimes|required|file',
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

            'category_id.required' => 'Поле "Рубрика" обязательно для заполнения',
            'category_id.exists' => 'Указанная рубрика не существует',

            'format.required' => 'Поле "Формат" обязательно для заполнения',
            'format.string' => 'Поле "Формат" должно быть строкой',

            'file.required' => 'Поле "Файл" обязательно для заполнения',
            'file.file' => 'Поле "Файл" должно быть файлом',

            'text.string' => 'Поле "Текст" должно быть строкой',

            'preview.file' => 'Поле "Превью" должно быть файлом',

            'video_link.url' => 'Поле "Ссылка на видео" должно быть валидным URL',
        ];
    }
}
