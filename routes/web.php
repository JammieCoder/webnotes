<?php

use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'dashboard')->name('dashboard');
Route::view('/login','auth.login')->name('login');
Route::get('/notes',[NoteController::class, 'index'])->name('notes');
Route::get('/modules/{module}',[ModuleController::class, 'show']);
