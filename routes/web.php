<?php

use App\Http\Controllers\Backend\Admin\AdminProfileController;
use App\Http\Controllers\Backend\Admin\AmbulanceController;
use App\Http\Controllers\backend\Admin\DashboardAdminController;
use App\Http\Controllers\Backend\Admin\DoctorController;
use App\Http\Controllers\Backend\Admin\DriverController;
use App\Http\Controllers\Backend\Admin\PattientController;
use App\Http\Controllers\Backend\Admin\SectionController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Doctor\DashboardDoctorController;
use App\Http\Controllers\Backend\Doctor\DoctorProfileController;
use App\Http\Controllers\backend\User\DashboardUserController;
use App\Http\Controllers\Backend\User\PattientProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group([
    'middleware'=>'auth:web'
],function(){
    Route::get('/dashboard',[DashboardUserController::class,'index'])->name('dashboard');
     //profile controller
     Route::get('pattient/profile/edit', [PattientProfileController::class,'edit'])->name('pattient.profile.edit');
     Route::patch('pattient/profile/update', [PattientProfileController::class,'update'])->name('pattient.profile.update');

});

Route::group([
    'middleware'=>'auth:admin'
],function(){
    Route::get('/dashboard/admin',[DashboardAdminController::class,'index'])->name('dashboard.admin');
    Route::put('/dashboard/{doctor}/UpdateStatus/doctor',[DoctorController::class,'updateStatus'])->name('doctor.updateStatus');
    Route::put('/dashboard/{doctor}/UpdatePassword/doctor',[DoctorController::class,'updatePassword'])->name('doctor.updatePassword');

    Route::put('/dashboard/admin/{id}/UpdateStatus/pattient',[PattientController::class,'updateStatus'])->name('pattient.updateStatus');
    Route::put('/dashboard/admin/{id}/UpdatePassword/pattient',[PattientController::class,'updatePassword'])->name('pattient.updatePassword');

    Route::put('/dashboard/admin/{id}/UpdateStatus/ambulances',[AmbulanceController::class,'updateStatus'])->name('ambulance.updateStatus');

    Route::put('/dashboard/admin/{id}/UpdateStatus/driver',[DriverController::class,'updateStatus'])->name('driver.updateStatus');


     //profile controller
   Route::get('admin/profile/edit', [AdminProfileController::class,'edit'])->name('admin.profile.edit');
   Route::patch('admin/profile/update', [AdminProfileController::class,'update'])->name('admin.profile.update');


    Route::resources([
        'section'=>SectionController::class,
        '/admin/doctor'=>DoctorController::class,
        'pattient'=>PattientController::class,
        'ambulance'=>AmbulanceController::class,
        'driver'=>DriverController::class,
    ]);

});


Route::group([
    'middleware'=>'auth:doctor'
],function(){
    Route::get('/dashboard/doctor',[DashboardDoctorController::class,'index'])->name('dashboard.doctor');
    Route::get('doctor/profile/edit', [DoctorProfileController::class,'edit'])->name('doctor.profile.edit');
    Route::patch('doctor/profile/update', [DoctorProfileController::class,'update'])->name('doctor.profile.update');

});

require __DIR__.'/auth.php';
