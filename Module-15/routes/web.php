<?php

use App\Http\Controllers\DemoController;
use App\Http\Middleware\DemoMiddleware;
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

// Route::get('/', function () {
//     return view('welcome');
// });
    // Route::get('/hello', [DemoController::class, "DemoAction"]) -> middleware([DemoMiddleware::class]);     //no 21
    // Route::get('/admin/{auth?}', [DemoController::class, 'admin']) -> middleware([DemoMiddleware::class]);  //no 22
    // Route::get('/login', [DemoController::class, 'login']);                                                 //no 22

Route::middleware(['demo']) -> group(function(){                                                   //no 23
    Route::get('/hello', [DemoController::class, 'DemoAction']);     //no 21
    Route::get('/admin/{auth?}', [DemoController::class, 'admin']);  //no 22
    Route::get('/login', [DemoController::class, 'login']);          //no 22
});
                                               