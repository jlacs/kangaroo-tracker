<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KangarooController;

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

Route::get('kangaroo', [KangarooController::class, 'index'])->name('kangaroo');
Route::get('grid', [KangarooController::class, 'grid'])->name('grid');
Route::post('create', [KangarooController::class, 'store']);
Route::post('update', [KangarooController::class, 'edit']);
Route::post('delete', [KangarooController::class, 'destroy']);