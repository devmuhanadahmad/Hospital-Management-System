<?php

namespace App\Http\Controllers\backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    public function index(){
        return view('backend.user.dashboard');
    }
}
