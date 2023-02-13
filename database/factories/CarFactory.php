<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
       
        $brand = ["BMW", "Mercedes","Renault"];
        $brand_model = [
        ["iX", "İ7","İ4"],
        ["EQ", "AMG","MAYBACH"],
        ["Clio", "Megane","Taliant"],
        ];
        $random= rand(0,count($brand)-1);
   
        return [
            'car_name' => $brand[$random],
            'car_plate' => rand(1,81).Str::upper($this->faker->bothify(' ??? ####')) ,
            'car_model' => $this->faker->randomElement($brand_model[$random]),
            'car_info' => $this->faker->paragraph($nbSentences = 2, $variableNbSentences = true),
        ];
    }

   
}
