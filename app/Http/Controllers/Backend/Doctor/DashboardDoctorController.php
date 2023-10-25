<?php

namespace App\Http\Controllers\Backend\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardDoctorController extends Controller
{
    public function index(){
        return view('backend.doctor.dashboard');
    }
}
