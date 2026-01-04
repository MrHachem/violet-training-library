<?php

namespace App\Http\Requests\Author;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAuthorRequest extends FormRequest
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
        $author_id = $this->route('author');

        return [
            'first_name' => ['sometimes', 'string', 'min:1', 'max:255'],
            'last_name' => ['sometimes', 
                            'string', 
                            'min:1',
                            'max:255', 
                            Rule::unique('authors')->where(function($query){
                                return $query->where('first_name', $this->first_name)
                                             ->where('last_name', $this->last_name);
                            })->ignore($author_id)],

            'personal_picture' => ['sometimes', 'nullable','image', 'mimes:jpg,jpeg,png', 'max:5120'],

            'birth_date' => ['sometimes','date', 'before:'.now()->subYears(4)->format('Y-m-d')], 
            // why? because there is a young author he was 4 year old and 218 days his name is Rashed Al Mheiri
            'death_date' => ['sometimes', 'nullable','date', 'before_or_equal:'.now()->format('Y-m-d')],
        ];
    }
}
