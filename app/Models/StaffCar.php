<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StaffCar extends Model
{
    use HasFactory;

    protected $table= "staff_car";
    protected $fillable = ['staff_id','car_id'];


    // Staff
    public function staff():HasOne{
        return $this->hasOne(Staff::class,'id', 'staff_id');
    }

    // Car
    public function car():HasOne{
        return $this->hasOne(Car::class,'id', 'car_id');
    }
}
