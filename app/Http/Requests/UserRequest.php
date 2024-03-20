<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UserRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:30'],
            'address' => ['nullable', 'string', 'max:255'],
            'avatar' => ['nullable', 'mimes:jpg,jpeg,png,webp', 'file'],
            'address.*.id' => ['nullable', 'numeric'],
            'address.*.address' => ['nullable', 'string'],
        ];
        if (! $this->user) {
            $rules['password'] = ['required', 'confirmed', Rules\Password::defaults()];
            $rules['avatar'] = ['required', 'mimes:jpg,jpeg,png,webp', 'file'];
        }

        return $rules;
    }
}
