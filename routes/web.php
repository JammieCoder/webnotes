<?php

use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TopicController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

Route::get('/',fn()=>Auth::check()?redirect()->route('dashboard'):view('home'))
    ->name('home');
Route::delete('/',function(){
    Auth::logout();
    return view('home');
});
Route::view('/dashboard', 'dashboard')
    ->name('dashboard')
    ->middleware('auth');

Route::get('/notes',[NoteController::class, 'index'])
    ->middleware('auth')
    ->name('notes');
Route::post('/notes', [NoteController::class, 'store'])
    ->middleware('auth')
    ->name('notes.store');
Route::delete('/notes/{note}',[NoteController::class,'destroy'])
    ->middleware('auth')
    ->can('view','note')
    ->name('notes.destroy');
Route::put('/notes/{note}',[NoteController::class,'update'])
    ->middleware('auth')
    ->can('view','note')
    ->name('notes.update');


Route::post('/modules', [ModuleController::class, 'store'])
    ->middleware('auth')
    ->name('modules.store');
Route::delete('/modules/{module}',[ModuleController::class,'destroy'])
    ->middleware('auth')
    ->can('view','module')
    ->name('modules.destroy');
Route::get('/modules/{module}',[ModuleController::class, 'show'])
    ->middleware('auth')
    ->can('view','module');

Route::post('/topics', [TopicController::class, 'store'])
    ->middleware('auth')
    ->name('topics.store');
Route::delete('/topics/{topic}',[TopicController::class,'destroy'])
    ->middleware('auth')
    ->can('view','topic')
    ->name('topics.destroy');

Route::get('/auth/redirect', function () {
    if(Auth::check())
        return redirect()->route('dashboard');
    return Socialite::driver('google')->redirect();
})->name('login');

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
