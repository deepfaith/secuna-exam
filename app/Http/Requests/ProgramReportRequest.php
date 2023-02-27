<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class ProgramReportRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $user = Auth::guard()->user();
        return [
            'title'       => 'required|max:255',
            'description' => 'nullable|max:5000',
            'record_status' => 'integer|not_in:0',
            'program_id'       => 'required|integer|exists:programs,id,user_id,'.$user->id,
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
            'program_id.required'  => 'Program Id is required',
            'program_id.integer'  => 'Program Id should be integer',
            'program_id.exists'  => 'Program Id should exists and belongs to the user',
            'record_status.not_in'  => 'Record status Value cannot be zero',
            'record_status.integer'  => 'Record status should be integer',
        ];
    }
}
