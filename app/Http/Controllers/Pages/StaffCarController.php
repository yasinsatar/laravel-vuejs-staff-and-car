<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffCarController extends Controller
{
    public function index(){
        return view('pages.staffCar.index');
    }

    public function create(){
        return view('pages.staffCar.create');
    }

    public function update(){
        return view('pages.staffCar.update');
    }

    public function detail(){
        return view('pages.staffCar.detail');
    }
}
