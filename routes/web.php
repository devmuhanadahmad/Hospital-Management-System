<?php

use App\Http\Controllers\backend\Admin\DashboardAdminController;
use App\Http\Controllers\Backend\Admin\DoctorController;
use App\Http\Controllers\Backend\Admin\SectionController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\backend\User\DashboardUserController;
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

});

Route::group([
    'middleware'=>'auth:admin'
],function(){
    Route::get('/dashboard/admin',[DashboardAdminController::class,'index'])->name('dashboard.admin');
    Route::put('/dashboard/{doctor}/UpdateStatus',[DoctorController::class,'updateStatus'])->name('doctor.updateStatus');
    Route::put('/dashboard/{doctor}/UpdatePassword',[DoctorController::class,'updatePassword'])->name('doctor.updatePassword');


    Route::resources([
        'section'=>SectionController::class,
        'doctor'=>DoctorController::class,
    ]);

});

require __DIR__.'/auth.php';
