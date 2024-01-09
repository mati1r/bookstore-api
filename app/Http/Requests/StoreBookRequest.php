<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null && $user->tokenCan('user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'publisher' => ['required','string'],
            'title' => ['required','string'],
            'price' => ['required','integer'],
            'publish_year'=> ['required','integer'],
            'picture' => ['required', 'image'],
            'author_ids' => ['required','array'],
            'author_ids.*' => ['exists:authors,id'],
            'genre_ids' => ['required','array'],
            'genre_ids.*' => ['exists:genres,id'],
        ];
    }
}
