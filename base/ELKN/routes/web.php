<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Auth\UsuarioController;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\UsuarioPerfilController;
///////////////////////////////////////////////////////////
////// Define Gates for role-based access control /////////
///////////////////////////////////////////////////////////

//////////////////////////////////////
////// Rutes web free access /////////
//////////////////////////////////////

Route::get('/', function () {

    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    return Inertia::render('auth/Login');

})->name('home');


///////////////////////////////////////////
////// Rutes web with authentication /////////
///////////////////////////////////////////

Route::get('dashboard', fn() => Inertia::render('Dashboard'))
    ->middleware('auth:sanctum', 'ability:dashboard')
    ->name('dashboard');

Route::get('usuarios/profile', fn() => Inertia::render('User'))
    ->middleware('auth:sanctum', 'ability:usuarios')
    ->name('usuarios');


//////////////////////////////////////////
////// Rutes login web /////////
//////////////////////////////////////////
Route::post('/web/login', function (Request $request) {

    $request->validate([
        'login' => 'required|string|max:255',
        'password' => 'required|string|max:255',
    ]);

    $credentials = [
        'usuario' => $request->login,
        'password' => $request->password
    ];

    if (!Auth::attempt($credentials)) {
        return response()->json(['message' => 'Credenciales inválidas'], 401, [], JSON_UNESCAPED_UNICODE);
    }

    $request->session()->regenerate();

    $user = Auth::user();

    if ($user->perfil?->id == 1) {
        $abilities = ['*'];
    } elseif ($user->perfil?->id == 2) {
        $abilities = ['dashboard', 'usuarios'];
    } else {
        $abilities = [];
    }

    $token = $user->createToken(
        'auth_token',
        $abilities,
        now()->addHours(8)
    )->plainTextToken;

    return response()->json([
        'message' => 'Bienvenido ' . $user->nombre,
        'token' => $token,
        'user' => $user,
    ], 200, [], JSON_UNESCAPED_UNICODE);
});


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
