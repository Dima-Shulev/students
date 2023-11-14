<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidScheduleLection extends FormRequest
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
            'curriculum_id' => ['required','int'],
            'lecture_id' => ['required','int'],
            'schedule' => ['required','date']
        ];
    }
}
