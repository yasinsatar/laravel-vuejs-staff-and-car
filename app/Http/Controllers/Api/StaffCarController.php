<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StaffCar;
use Illuminate\Http\Request;

class StaffCarController extends Controller
{
    public function index(){
        $stockCards = StaffCar::with('staff','car')->paginate(5);
        return response()->json($stockCards);
    }


    public function store(Request $request)
    {
        
    }
    
    public function show(Request $request)
    {


    }
    public function update(Request $request){
     
    }

    public function destroy(Request $request){
     
    }
}
