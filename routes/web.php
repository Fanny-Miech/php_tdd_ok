<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/', function(){
//     return view('project');
// });

Route::get('/project',  [\App\Http\Controllers\ProjectController::class, 'index']);
Route::get('/project/{id}', [\App\Http\Controllers\ProjectController::class, 'show']);
Route::get('/project/create', [\App\Http\Controllers\ProjectController::class, 'create']);
Route::post('/project', [\App\Http\Controllers\ProjectController::class, 'store']);
Route::get('/project/{id}/edit', [\App\Http\Controllers\ProjectController::class, 'edit']);
Route::put('/project/{id}', [\App\Http\Controllers\ProjectController::class, 'update']);
Route::delete('/project/{id}', [\App\Http\Controllers\ProjectController::class, 'destroy']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
