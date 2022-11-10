<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionPostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'question.title' => 'required|string|max:50',
            'question.body' => 'required|string|max:4000',
            'question.file_path' => 'required|string|max:255',
            'question.category_id' => 'required|integer|max:20'
        ];
    }
}
