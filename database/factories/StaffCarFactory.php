<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Staff;
use App\Models\StaffCar;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class StaffCarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $exc_staff = Staff::whereNotIn('id', StaffCar::all()->pluck('staff_id'))->pluck("id");
        $exc_car   = Car::whereNotIn('id',StaffCar::all()->pluck('car_id'))->pluck("id");
       
        return [
            'staff_id' => $this->faker->unique()->randomElement($exc_staff),
            'car_id' => $this->faker->unique()->randomElement($exc_car) 
        ];
    }
    

  
}
