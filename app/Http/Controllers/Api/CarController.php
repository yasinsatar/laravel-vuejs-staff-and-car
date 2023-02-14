<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\StaffCar;
use Illuminate\Http\Request;
use stdClass;

class CarController extends Controller
{
    public function index(){
        $result = new stdClass();
        $result->status = false;
        $result->data = [];
        $result->message = "";
        $staffs=null;
        try{
            $staffs = Car::all(['id','car_plate'])->whereNotIn('id', StaffCar::all('car_id')->pluck('car_id'));
            $result->status = true;
            $result->data = $staffs;
        }catch(\Exception $e){
            $result->message = "An error occurred while accessing the database.";
        }
         
        return response()->json($result);
    }
}
