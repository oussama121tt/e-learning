<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\instructorcontroller;
use App\Http\Controllers\userController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
/// admin groupe middlware
route::middleware(['auth','roles:admin'])->group(function(){
Route::get('/Admin/Dashboard', [admincontroller::class, 'admindashboard'])->name('Admin.Dashboard');
Route::get('/Admin/logout', [adminController::class, 'adminlogout'])->name('admin.logout');

Route::get('/Admin/profile', [adminController::class, 'adminprofile'])->name('admin.profile');
Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
});/// end admin groupe middlware
Route::get('/Admin/login', [admincontroller::class, 'adminlogin'])->name('admin.login');
/// instructor groupe middlware
route::middleware(['auth','roles:instructor'])->group(function(){
Route::get('/Instructor/Dashboard', [instructorcontroller::class, 'instructordashboard'])->name('instructor.dashboard');
Route::get('/instructor/logout', [InstructorController::class, 'InstructorLogout'])->name('instructor.logout');
Route::get('/instructor/profile', [InstructorController::class, 'InstructorProfile'])->name('instructor.profile');
Route::post('/instructor/profile/store', [InstructorController::class, 'InstructorProfileStore'])->name('instructor.profile.store');
Route::get('/instructor/change/password', [InstructorController::class, 'InstructorChangePassword'])->name('instructor.change.password');
Route::post('/instructor/password/update', [InstructorController::class, 'InstructorPasswordUpdate'])->name('instructor.password.update');


});/// end instructor groupe middlware

Route::get('/instructor/login', [InstructorController::class, 'InstructorLogin'])->name('instructor.login');



