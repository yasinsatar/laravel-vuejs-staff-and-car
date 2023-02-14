<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStaffCarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /* public function authorize()
    {
        return auth()->check();
    } */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'staff_id' => 'required|exists:staffs,id|unique:staff_car,staff_id',
            'car_id' => 'required|exists:cars,id|unique:staff_car,car_id',
        ];
    }

    public function attributes(){
        return [
            'staff_id' => 'Staff',
            'car_id' => 'Car'
        ];
    }
}
