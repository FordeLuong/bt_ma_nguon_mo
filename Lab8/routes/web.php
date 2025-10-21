<?php
use App\Http\Controllers\StudentController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
Route::get('/', function () {
    return view('welcome');
});
Route::resource('products', ProductController::class);
Route::resource('students', StudentController::class);

