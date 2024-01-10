<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
                'payment_id' => ['required','exists:payments,id'],
                'order_date' => ['required'],
                'state'=> ['required','string'],
                'city' => ['required','string'],
                'street' => ['required','string'],
                'building_number' => ['required','integer'],
                'apartment_number' => ['required','integer'],
                'zip_code' => ['required', 'regex:/^\d{2}-\d{3}$/'],
                'total_price' => ['required','numeric'],
                'books' => ['required','array'],
                'books.*.book_id' => ['required', 'exists:books,id'],
                'books.*.amount' => ['required', 'integer', 'gt:0'],
            ];
        }
        else{
            return [
                'payment_id' => ['sometimes','required','exists:payments,id'],
                'order_date' => ['sometimes','required'],
                'state'=> ['sometimes','required','string'],
                'city' => ['sometimes','required','string'],
                'street' => ['sometimes','required','string'],
                'building_number' => ['sometimes','required','integer'],
                'apartment_number' => ['sometimes','required','integer'],
                'zip_code' => ['sometimes','required', 'regex:/^\d{2}-\d{3}$/'],
                'total_price' => ['sometimes','required','numeric'],
                'books' => ['sometimes','required','array'],
                'books.*.book_id' => ['sometimes','required', 'exists:books,id'],
                'books.*.amount' => ['sometimes','required', 'integer', 'gt:0'],
                ];
        }
    }
}
