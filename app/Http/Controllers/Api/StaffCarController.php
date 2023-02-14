<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StaffCar\ShowStaffCarRequest;
use App\Http\Requests\Api\StaffCar\StoreStaffCarRequest;
use App\Http\Requests\Api\StaffCar\UpdateStaffCarRequest;
use App\Models\Car;
use App\Models\Staff;
use App\Models\StaffCar;
use Illuminate\Http\Request;
use stdClass;

class StaffCarController extends Controller
{
    public function index()
    {
        $stockCards = StaffCar::with('staff', 'car')->paginate(5);
        return response()->json($stockCards);
    }


    public function store(StoreStaffCarRequest $request)
    {
        $result = new stdClass();
        $result->status = false;
        $result->data = [];
        $result->message = "Created failed.";
        $staffs = null;
        try {
            $staffCar = new StaffCar;
            $staffCar->staff_id = $request->validated('staff_id');
            $staffCar->car_id = $request->validated('car_id');
            $staffCar->save();
            $result->status = true;
            $result->data = $staffs;
            $result->message = "Created success.";
        } catch (\Exception $e) {
            $result->message = "An error occurred while accessing the database.";
        }

        return response()->json($result);
    }

    public function show($id)
    {
        $result = new stdClass();
        $result->status = false;
        $result->data = [];
        $result->message = "";
        $staffs=null;
        try{
            $result->data =StaffCar::with('staff','car')->findOrFail($id);
        }catch(\Exception $e){
            $result->message = "An error occurred while accessing the database.";
        }
         
        return response()->json($result);
    }

    
    public function edit($id)
    {
        $result = new stdClass();
        $result->status = false;
        $result->data = [];
        $result->message = "";
        $staffs=null;
        try{
            $staffCar = StaffCar::where('id',$id)->get();
            $result->status = true;
            $result->data["car"] = Car::where('id',$staffCar->pluck('car_id'))->first();
            $result->data["staff"] = Staff::where('id',$staffCar->pluck('staff_id'))->first();
            
            $staffCars= (array) StaffCar::all('staff_id')->pluck('staff_id') ;
            unset( $staffCars[array_search( $result->data["staff"]->id, $staffCars )] );
            $result->data["staffs"] =Staff::all(['id','name'])->whereNotIn('id',$staffCars) ;
        }catch(\Exception $e){
            $result->message = "An error occurred while accessing the database.";
        }
         
        return response()->json($result);
    }
    public function update(UpdateStaffCarRequest $request,$id)
    {
        $result = new stdClass();
        $result->status = false;
        $result->data = [];
        $result->message = "Updated failed.";
        $staffs = null;
        try {
            $staffCar = StaffCar::findOrFail($id);
            $staffCar->staff_id = $request->validated('staff_id');
            $staffCar->update();
            $result->status = true;
            $result->data = $staffs;
            $result->message = "Updated success.";
        } catch (\Exception $e) {
            $result->message = $e->getMessage();
        }

        return response()->json($result);
    }

    public function destroy($id)
    {
        $result = new stdClass();
        $result->status = false;
        $result->data = [];
        $result->message = "Deleted failed.";
        $staffs = null;
        try {
        $staffCar= StaffCar::findOrFail($id);
        $staffCar->delete();
        $result->message = "Deleted success.";
    } catch (\Exception $e) {
        $result->message = $e->getMessage();
    }

    return response()->json($result);
    }
}
