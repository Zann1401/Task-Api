<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Endpoint pertama: GET yang me-return teks biasa
Route::get('/hello', function () {
 return 'Halo dari Laravel 12!';
});

// GET yang me-return JSON manual
Route::get('/info', function () {
    return response()->json([
        'app' => 'Task API',
        'version' => '1.0',
        'author' => 'BTNG DNCC 2026',
    ]);
}); 

// POST statis yang me-return JSON manual
Route::post('/hello', function () {
    return response()->json([
        'message' => 'Request POST berhasil diterima!',
    ]);
});

Route::get('/tasks/{id}', [TaskController::class, 'show'])->whereNumber('id');
Route::put('/tasks/{id}', [TaskController::class, 'store'])->whereNumber('id');
Route::put('/tasks/{id}', [TaskController::class, 'update'])->whereNumber('id');
Route::patch('/tasks/{id}', [TaskController::class, 'patch'])->whereNumber('id');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->whereNumber('id');