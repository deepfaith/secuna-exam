<?php

namespace App\Http\Requests;

use App\Constants\DateFormatConstants;

class ProgramUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|max:255',
            'description' => 'nullable|max:5000',
            'start_date'       => 'date_format:'.DateFormatConstants::DEFAULT_FORMAT,
            'end_date'       => 'date_format:'.DateFormatConstants::DEFAULT_FORMAT,
            'image'       => 'nullable|image|mimes:png,jpg,jpeg,gif,webp|max:2048',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     * Custom validation message
     */
    public function messages(): array
    {
        return [
            'title.required'  => 'Program title is required',
            'title.max'       => 'Program title is maximum of 255 characters',
            'description.max' => 'Program description is maximum of 5000 characters',
            'start_date.required'  => 'Start Date is required',
            'start_date.date_format'  => 'Start Date Format is Y-m-d (2023-01-27 PM)',
            'end_date.numeric'   => 'End Date is required',
            'end_date.date_format'  => 'End Date Format is Y-m-d G:i A (2023-01-27 AM)',
            'image.image'     => 'Please give a valid product image',
            'image.max'       => 'Program image max 2MB is allowed',
        ];
    }
}
