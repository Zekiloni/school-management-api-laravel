<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Student API Routes
 */
Route::get('/student', [StudentController::class, 'listStudents']);
Route::get('/student', [StudentController::class, 'createStudent']);
Route::get('/student/{id}', [StudentController::class, 'retrieveStudent']);
Route::patch('/student/{id}', [StudentController::class, 'patchStudent']);
Route::delete('/student/{id}', [StudentController::class, 'deleteStudent']);
