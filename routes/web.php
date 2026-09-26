<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

// Home page (uses the new home view)
Route::get('/', function () {
    return view('home');
})->name('home');

// Login form (GET)
Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

// Login submit (POST)
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
})->middleware('guest')->name('login.attempt');

// Registration form (GET)
Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest')->name('register');

// Registration submit (POST)
Route::post('/register', function (Request $request) {
    $data = $request->validate([
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        'phone_number' => ['required', 'string', 'max:15'],
        'barangay_id_number' => ['nullable', 'string', 'max:50'],
        'complete_address' => ['required', 'string', 'max:1000'],
        'password' => ['required', 'confirmed', 'min:8'],
        'terms' => ['accepted'],
    ]);

    // Get default resident role (FixRolesSeeder creates 'admin' and 'resident')
    $residentRole = \App\Models\Role::where('name', 'resident')->first();
    if (!$residentRole) {
        // preserve old input when bouncing back so form fields are not cleared
        return back()->withErrors(['error' => 'System roles not set up properly.'])->withInput();
    }

    $user = User::create([
        'role_id' => $residentRole->id,
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'email' => $data['email'],
        'phone_number' => $data['phone_number'],
        'barangay_id_number' => $data['barangay_id_number'] ?? null,
        'complete_address' => $data['complete_address'],
        'password' => Hash::make($data['password']),
        'is_active' => true,
    ]);

    Auth::login($user);
    $request->session()->regenerate();

    return redirect()->intended('/');

})->middleware('guest')->name('register.submit');


// Logout (POST)
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home');
})->middleware('auth')->name('logout');

// Dashboard Routes
Route::middleware(['auth'])->group(function () {
    // User Dashboard
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        
        // Admin Management Routes
        Route::get('/users', function () {
            return view('admin.users.index');
        })->name('users');

        Route::get('/requests', function () {
            return view('admin.requests.index');
        })->name('requests');
    });
});

