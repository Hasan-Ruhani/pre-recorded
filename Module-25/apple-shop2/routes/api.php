<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post("/PaymentIPN",[InvoiceController::class,'PaymentIPN']);
