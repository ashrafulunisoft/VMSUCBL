<?php

use App\Models\User;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Test\TestController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

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

// Send reset email to currently authenticated user
Route::post('/profile/send-reset-email', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
    ]);

    $status = Password::sendResetLink($request->only('email'));

    return back()->with('status', $status === Password::RESET_LINK_SENT
        ? __($status)
        : __('Failed to send reset link. ' . __($status)));
})->name('profile.send-reset-email');


/*
|--------------------------------------------------------------------------
| Authenticated pages
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Test email route
Route::get('/test-mail', function() {
    try {
        Mail::raw('This is a test email from Laravel', function($message) {
            $message->to('ashrafulunisoft@gmail.com')
                    ->subject('Test Email');
        });
        return 'Email sent successfully! Check your inbox.';
    } catch (\Exception $e) {
        return 'Error sending email: ' . $e->getMessage();
    }
});





//----------------- Only for the test ----------------------

Route::get('/play',[App\Http\Controllers\Test\TestController::class,'play']);
Route::post('/upload',[App\Http\Controllers\Test\TestController::class,'upload'])->name('upload');




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
