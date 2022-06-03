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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/getUsers',[App\Http\Controllers\HomeController::class, 'getUsers'])->middleware(['auth']);
Route::post('/session/create',[App\Http\Controllers\SessionController::class, 'create'])->middleware(['auth']);
Route::post('/send/{session}',[App\Http\Controllers\ChatController::class, 'send'])->middleware(['auth']);
Route::post('/send-image/{session}',[App\Http\Controllers\ChatController::class, 'sendFile'])->middleware(['auth']);
Route::post('/session/{session}/chats',[App\Http\Controllers\ChatController::class, 'chats'])->middleware(['auth']);
Route::post('/session/{session}/read',[App\Http\Controllers\ChatController::class, 'read'])->middleware(['auth']);
Route::post('/session/{session}/clear',[App\Http\Controllers\ChatController::class, 'clear'])->middleware(['auth']);
Route::post('/session/{session}/block',[App\Http\Controllers\BlockController::class, 'block'])->middleware(['auth']);
Route::post('/session/{session}/unblock',[App\Http\Controllers\BlockController::class, 'unblock'])->middleware(['auth']);

