<?php

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

Route::get('/apidocs', function () {
    return view('apidocs');
});

Route::get('/tasks',[App\Http\Controllers\TaskController::class , 'index']);

Route::get('test',function(){
    return response()->json(['message'=>'Welcome Alaa !']);
});
