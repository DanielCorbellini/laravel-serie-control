<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            'cover' => $this->cover ?? null,  // Define o valor padrão de cover como null
        ]);
    }
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
            'name' => ['required', 'min:3'],
            'cover' => 'nullable|string',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => "O campo nome é obrigatório",
            'name.min' => "O campo nome precisa ter mais de 2 caracteres"
        ];
    }
}
