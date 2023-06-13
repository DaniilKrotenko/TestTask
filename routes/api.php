<?php

use App\Http\Controllers\Cat\CatController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Shelter\ShelterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::get('/shelters', [ShelterController::class, 'getShelters']);
Route::post('/shelter/add', [ShelterController::class, 'addShelter']);
Route::post('/shelter/update', [ShelterController::class, 'updateShelter']);
Route::delete('/shelter/delete', [ShelterController::class, 'deleteShelter']);

Route::get('/employees', [EmployeeController::class, 'getEmployees']);
Route::post('/employee/add', [EmployeeController::class, 'addEmployee']);
Route::post('/employee/update', [EmployeeController::class, 'updateEmployee']);
Route::delete('/employee/delete', [EmployeeController::class, 'deleteEmployee']);

Route::get('/cats', [CatController::class, 'getCats']);
Route::post('/cat/add', [CatController::class, 'addCat']);
Route::put('/cat/update', [CatController::class, 'updateCat']);
Route::delete('/cat/delete', [CatController::class, 'deleteCat']);
