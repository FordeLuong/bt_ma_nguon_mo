<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PageController;

Route::get('/hello', function () {
    return 'Xin chào Laravel 12!';
});

Route::get('/time', function () {
    return now()->format('H:i:s d/m/Y');
});

Route::get('/sum/{a}/{b}', function ($a, $b) {
    if (!is_numeric($a) || !is_numeric($b)) {
        return response('Tham số phải là số nguyên', 400);
    }
    return (int)$a + (int)$b;
});

Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/db', [StudentController::class, 'indexDb']);
Route::get('/students/combined', [StudentController::class, 'combined']);
Route::get('/students/create', [StudentController::class, 'create']);
Route::post('/students', [StudentController::class, 'store']);

Route::get('/about', [PageController::class, 'about']);
