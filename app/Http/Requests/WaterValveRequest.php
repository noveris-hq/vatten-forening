<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WaterValveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'location_description' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'is_open' => 'nullable|boolean',
        ];
    }

    /**
     * Get the custom error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'user_id.required' => 'Du måste välja en användare.',
            'user_id.exists' => 'Den valda användaren finns inte.',
            'location_description.required' => 'Platsbeskrivning är obligatorisk.',
            'location_description.max' => 'Platsbeskrivning får max vara 255 tecken.',
            'latitude.required' => 'Latitud är obligatoriskt.',
            'latitude.numeric' => 'Latitud måste vara ett nummer.',
            'latitude.between' => 'Latitud måste vara mellan -90 och 90.',
            'longitude.required' => 'Longitud är obligatoriskt.',
            'longitude.numeric' => 'Longitud måste vara ett nummer.',
            'longitude.between' => 'Longitud måste vara mellan -180 och 180.',
        ];
    }
}
