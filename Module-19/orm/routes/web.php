<?php
use App\Http\Controllers\demoController;
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

Route::post('/create-brand', [demoController::class, 'demoAction']);
Route::post('/update-brand/{id}', [demoController::class, 'demoAction']);
Route::post('/create-update-brand/{brandName}', [demoController::class, 'demoAction']);
Route::get('/delete/{id}', [demoController::class, 'demoAction']);
Route::get('/find', [demoController::class, 'demoAction']);
Route::get('/find-column', [demoController::class, 'demoAction']);
