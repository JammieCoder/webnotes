<?php

use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NoteController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

Route::view('/dashboard', 'dashboard')->name('dashboard');
Route::view('/login','auth.login')->name('login');
Route::get('/notes',[NoteController::class, 'index'])->name('notes');
Route::get('/modules/{module}',[ModuleController::class, 'show']);
Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/callback', function () {
    $googleUser = Socialite::driver('google')->user();

    $user = User::updateOrCreate([
        'google_id' => $googleUser->id,
    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
        'google_token' => $googleUser->token,
        'google_refresh_token' => $googleUser->refreshToken,
        'google_expires_in' => $googleUser->expiresIn,
        'password' => Hash::make(Str::random(12)),
    ]);

    Auth::login($user);

    return redirect()->route('dashboard');
});
