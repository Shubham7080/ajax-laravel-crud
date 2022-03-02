<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

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

Route::post("user",[FormController::class,"create"]);
Route::view("register","register");
Route::get('showdata',[FormController::class,'show_data']);
Route::post('delete_data',[FormController::class,'delete_data']);
Route::get('edit_data',[FormController::class,'edit_data']);


