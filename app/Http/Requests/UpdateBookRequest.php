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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('book');

        return [
            'ISBN' => ['sometimes', 'string', 'size:13', 'unique:books,ISBN,'.$id],

            'title' => ['sometimes', 'string', 'max:70'],

            'price' => ['sometimes', 'numeric', 'min:0', 'max:99.99'],
            'mortgage' => ['sometimes', 'numeric', 'min:0', 'max:9999.99'],

            'authorship_date' => ['sometimes', 'nullable', 'date'],

            'category_id' => ['sometimes', 'exists:categories,id'],
        ];
    }
}
