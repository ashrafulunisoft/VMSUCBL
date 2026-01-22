<?php

use App\Models\User;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\ProfileController;

//for create role and permission :
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordResetController;






/*
|--------------------------------------------------------------------------
| Those use for role base redirection .
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    "This is the dashboard page for no roles";
    return view('dashboard'); // dummy view (never actually shown)
})->middleware(['auth', 'verified', 'role.redirect'])
  ->name('dashboard');




/*
|--------------------------------------------------------------------------
| Role-wise Dashboards
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/role/create', [AdminController::class, 'createRole'])->name('admin.role.create');
    Route::post('/admin/role/store', [AdminController::class, 'storeRole'])->name('admin.role.store');
    Route::get('/admin/role/assign/create', [AdminController::class, 'createAssignRole'])->name('admin.role.assign.create');
    Route::post('/admin/role/assign/store', [AdminController::class, 'storeAssignRole'])->name('admin.role.assign.store');
    Route::post('/admin/role/assign/remove', [AdminController::class, 'removeUserRole'])->name('admin.role.assign.remove');
    Route::get('/admin/visitor/registration/create', [AdminController::class, 'createVisitorRegistration'])->name('admin.visitor.registration.create');
    Route::post('/admin/visitor/registration/store', [AdminController::class, 'storeVisitorRegistration'])->name('admin.visitor.registration.store');
    Route::get('/admin/visitor/registration/search-host', [AdminController::class, 'searchHost'])->name('admin.visitor.registration.search-host');
    Route::get('/admin/visitor/registration/check-visitor', [AdminController::class, 'checkVisitor'])->name('admin.visitor.registration.check-visitor');
    Route::get('/admin/visitor/registration/check-visitor-phone', [AdminController::class, 'checkVisitorByPhone'])->name('admin.visitor.registration.check-visitor-phone');
    Route::get('/admin/visitor/list', [AdminController::class, 'visitorList'])->name('admin.visitor.list');
    Route::get('/admin/visitor/{id}/edit', [AdminController::class, 'editVisitor'])->name('admin.visitor.edit');
    Route::post('/admin/visitor/{id}/update', [AdminController::class, 'updateVisitor'])->name('admin.visitor.update');
    Route::delete('/admin/visitor/{id}/delete', [AdminController::class, 'deleteVisitor'])->name('admin.visitor.delete');
});

Route::middleware(['auth', 'role:receptionist'])->group(function () {
    Route::get('/receptionist/dashboard', [App\Http\Controllers\Receptionist\ReceptionistController::class, 'dashboard'])
        ->name('receptionist.dashboard');
});

Route::middleware(['auth', 'role:visitor'])->group(function () {
    //  dd("This is the dashboard page for visitor");
    Route::get('/visitor/dashboard', function () {
        return "This is the dashboard page for visitor";
    })->name('visitor.dashboard');
    // Route::get('/visitor/dashboard', fn () => view('visitor.dashboard'))
    //     ->name('visitor.dashboard');
});

/*
|--------------------------------------------------------------------------
| Fallback (any other role → staff)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    //  dd("This is the dashboard page for staff");
    Route::get('/staff/dashboard', function () {
        return "This is the dashboard page for staff";
    })->name('staff.dashboard');
    // Route::get('/staff/dashboard', fn () => view('staff.dashboard'))
    //     ->name('staff.dashboard');
});



/*
|--------------------------------------------------------------------------
| Guest pages (guest only)
|--------------------------------------------------------------------------
*/


Route::get('/', function(){


// Role::create(['name' => 'admin']);
// Role::create(['name' => 'staff']);
// Role::create(['name' => 'receptionist']);
// Role::create(['name' => 'visitor']);

// dd(Role::all());
//---------- add role to any user --------------------------
    // $user = User::where('name','Staff')->first();
    // // dd($user);
    // $user->assignRole('staff');
    // dd($user->getRoleNames());
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


//---------------------------------------------------------------------------
//for logout :


Route::get('/test', function () {
    return "Test File";
    return redirect('/login');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});




// Test notification route
Route::get('/test-notification', function () {
    $visitor = \App\Models\Visitor::first();

    if (!$visitor) {
        return 'No visitor found in database. Create a visitor first.';
    }

    // Test email
    try {
        $visitor->notify(new \App\Notifications\VisitorRegistered($visitor, $visitor->visits()->first()));
        return 'Email notification sent successfully! Check your inbox.';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
})->name('test.notification');

// Test visitor registration email with EmailNotificationService
Route::get('/test-visitor-email', function () {
    $emailService = new \App\Services\EmailNotificationService();

    $emailData = [
        'visitor_name' => 'Test Visitor',
        'visitor_email' => 'ashrafulunisoft@gmail.com',
        'visitor_phone' => '+8801234567890',
        'visitor_company' => 'Test Company',
        'visit_date' => 'January 25, 2026 - 2:30 PM',
        'visit_type' => 'Business Meeting',
        'purpose' => 'Testing email notification service',
        'host_name' => 'Test Host',
        'status' => 'approved',
    ];

    try {
        $result = $emailService->sendVisitorRegistrationEmail($emailData);
        return $result
            ? '✅ Visitor registration email sent successfully! Check ashrafulunisoft@gmail.com'
            : '❌ Failed to send email. Check logs for details.';
    } catch (\Exception $e) {
        return '❌ Error: ' . $e->getMessage();
    }
})->name('test.visitor.email');

// -------------------------------------------------------------------------
// Visitor Management Routes (with permission middleware)
Route::middleware(['auth'])->group(function () {
    // API routes first (more specific)
    Route::get('/visitor/autofill', [App\Http\Controllers\Visitor\VisitorController::class, 'autofill'])->name('visitor.autofill');
    Route::get('/visitor/check-email', [App\Http\Controllers\Visitor\VisitorController::class, 'checkVisitorByEmail'])->name('visitor.check-email');
    Route::get('/visitor/check-phone', [App\Http\Controllers\Visitor\VisitorController::class, 'checkVisitorByPhone'])->name('visitor.check-phone');
    Route::get('/visitor/search-host', [App\Http\Controllers\Visitor\VisitorController::class, 'searchHost'])->name('visitor.search-host');
    Route::get('/visitor/statistics', [App\Http\Controllers\Visitor\VisitorController::class, 'statistics'])->name('visitor.statistics');

    // CRUD routes second (less specific)
    Route::get('/visitor', [App\Http\Controllers\Visitor\VisitorController::class, 'index'])->name('visitor.index');
    Route::get('/visitor/create', [App\Http\Controllers\Visitor\VisitorController::class, 'create'])->name('visitor.create');
    Route::post('/visitor', [App\Http\Controllers\Visitor\VisitorController::class, 'store'])->name('visitor.store');
    Route::get('/visitor/{id}', [App\Http\Controllers\Visitor\VisitorController::class, 'show'])->name('visitor.show');
    Route::get('/visitor/{id}/edit', [App\Http\Controllers\Visitor\VisitorController::class, 'edit'])->name('visitor.edit');
    Route::put('/visitor/{id}', [App\Http\Controllers\Visitor\VisitorController::class, 'update'])->name('visitor.update');
    Route::delete('/visitor/{id}', [App\Http\Controllers\Visitor\VisitorController::class, 'destroy'])->name('visitor.destroy');
});

// -------------------------------------------------------------------------
// Test SMS route
Route::get('/test-sms', function () {
    $smsService = new \App\Services\SmsNotificationService();

    $phone = '8801859385787'; // Test phone number (format: 880XXXXXXXXXX)
    $message = 'Sharmin I Love YOu ...!';
    // $message = 'This is a test SMS from VMS UCBL system. If you receive this, SMS is working!';

    try {
        $result = $smsService->send($phone, $message);

        if ($result['success']) {
            return '✅ SMS sent successfully to ' . $phone . '! Check your phone.';
        } else {
            return '❌ Failed to send SMS: ' . $result['message'];
        }
    } catch (\Exception $e) {
        return '❌ Error: ' . $e->getMessage();
    }
})->name('test.sms');

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
