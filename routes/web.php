<?php

use App\Http\Controllers\GenerateController;
use Illuminate\Support\Facades\App;
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

Route::domain(
    App::isProduction()
        ? 'cdn.curlwind.com'
        : 'cdn.curlwind.test'
)->name('cdn')->get('/', GenerateController::class);

Route::get('/', function () {
    return view('welcome');
});
