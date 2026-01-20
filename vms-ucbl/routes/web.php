<?php

use App\Models\User;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordResetController;

/*
|--------------------------------------------------------------------------
| Guest pages (guest only)
|--------------------------------------------------------------------------
*/


Route::get('/', function(){

//---------- add role to any user --------------------------
    // $user = User::latest()->first();
    // $user->assignRole('staff');
    // $user->removeRole('staff');

    // dd($user->getRoleNames());

//---------- add permission to any user ------------------------
// use Spatie\Permission\Models\Permission;
    // $user = User::latest()->first();
    // $user->givePermissionTo('create users');

    return "This is the Homepage ";
    return view('home');
})->name('home');



/*
|--------------------------------------------------------------------------
| Auth pages (guest only)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);


});



/*
|--------------------------------------------------------------------------
| Password Reset (ALLOW AUTH + GUEST)
|--------------------------------------------------------------------------
*/
Route::get('/forgot-password', [PasswordResetController::class, 'request'])
    ->name('password.request');

Route::post('/forgot-password-email', [PasswordResetController::class, 'email'])
    ->name('password.email');

Route::get('/reset-password/{token}', [PasswordResetController::class, 'reset'])
    ->name('password.reset');

Route::post('/reset-password', [PasswordResetController::class, 'update'])
    ->name('password.update');


/*
|--------------------------------------------------------------------------
| Authenticated pages
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});










// -------------------------------------------------------------------------
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
