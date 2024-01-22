<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class GenerateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'cache' => [
                'boolean',
            ],
            'preflight' => [
                'boolean'
            ],
            'prefix' => [
                'string',
                'max:10',
                'alpha_dash:ascii',
            ],
            'classes' => [
                'array',
            ],
            'classes.*' => [
                // {class}:{variants}
                'regex:/^[a-z0-9*-\/]+(:([a-z0-9-]+(\|[a-z0-9-]+)*))?$/u',
            ],
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'classes' => $this->csv('classes'),
        ]);
    }

    /**
     * Get an input as a CSV string.
     */
    public function csv(string $input): array
    {
        return array_values(
            Arr::sort(array_filter(explode(',', $this->input($input)))
        ));
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        return abort(422, $validator->errors()->first());
    }
}
