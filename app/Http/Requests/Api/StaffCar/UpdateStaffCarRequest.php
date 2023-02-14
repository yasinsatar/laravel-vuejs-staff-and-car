<?php

namespace App\Http\Requests\Api\StaffCar;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStaffCarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'staff_id' => 'required|exists:staffs,id',
        ];
    }

    public function attributes(){
        return [
            'staff_id' => 'Staff',
        ];
    }
}
