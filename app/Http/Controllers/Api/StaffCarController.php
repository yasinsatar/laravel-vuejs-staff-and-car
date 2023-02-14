<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStaffCarRequest;
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
        $result->message = "Create failed.";
        $staffs = null;
        try {
            $staffCar = new StaffCar;
            $staffCar->staff_id = $request->validated('staff_id');
            $staffCar->car_id = $request->validated('car_id');
            $staffCar->save();
            $result->status = true;
            $result->data = $staffs;
            $result->message = "Create success.";
        } catch (\Exception $e) {
            $result->message = "An error occurred while accessing the database.";
        }

        return response()->json($result);
    }

    public function show(Request $request)
    {
    }
    public function update(Request $request)
    {
    }

    public function destroy(Request $request)
    {
    }
}
