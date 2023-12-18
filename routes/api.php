<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

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
Route::get('/student', [StudentController::class, 'list_students']);
Route::post('/student', [StudentController::class, 'create_student']);
Route::get('/student/{id}', [StudentController::class, 'retrieve_student']);
Route::patch('/student/{id}', [StudentController::class, 'patch_student']);
Route::delete('/student/{id}', [StudentController::class, 'delete_student']);


/**
 * Teacher API Routess
 */
Route::get('/teacher', [TeacherController::class, 'index']);
