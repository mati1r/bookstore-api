<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null && $user->tokenCan('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();

        if($method == "PUT"){
            return [
                'publisher' => ['required','string'],
                'title' => ['required','string'],
                'price' => ['required','numeric'],
                'publish_year'=> ['required','integer'],
                'picture' => ['required', 'image'],
                'author_ids' => ['required','array'],
                'author_ids.*' => ['exists:authors,id'],
                'genre_ids' => ['required','array'],
                'genre_ids.*' => ['exists:genres,id'],
            ];
        }
        else{
            return [
                'publisher' => ['sometimes','required','string'],
                'title' => ['sometimes','required','string'],
                'price' => ['sometimes','required','numeric'],
                'publish_year'=> ['sometimes','required','integer'],
                'picture' => ['sometimes','required', 'image'],
                'author_ids' => ['sometimes','required','array'],
                'author_ids.*' => ['exists:authors,id'],
                'genre_ids' => ['sometimes','required','array'],
                'genre_ids.*' => ['exists:genres,id'],
            ];
        }
    }
}
