<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffCar;
use Illuminate\Http\Request;
use stdClass;

class StaffController extends Controller
{
    public function index(){
        $result = new stdClass();
        $result->status = false;
        $result->data = [];
        $result->message = "";
        $staffs=null;
        try{
            $staffs = Staff::all(['id','name'])->whereNotIn('id', StaffCar::all('staff_id')->pluck('staff_id'));
            $result->status = true;
            $result->data = $staffs;
        }catch(\Exception $e){
            $result->message = "An error occurred while accessing the database.";
        }
         
        return response()->json($result);
    }
}
