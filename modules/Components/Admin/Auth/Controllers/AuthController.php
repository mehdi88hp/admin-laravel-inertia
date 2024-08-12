<?php

namespace Modules\Components\Admin\Auth\Controllers;


use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Inertia\Inertia;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Modules\Components\Admin\Auth\Services\AuthService;

class AuthController
{
    public function loginForm()
    {
        return Inertia::render('Auth/Login', [
            'appUrl' => config('app.url')
        ]);
    }

    public function login0(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

//        if (Auth::attempt($credentials)) {
//
//            $request->session()->regenerate();
//
//            // Create a Sanctum token
//            $token = $request->user()->createToken('auth-token')->plainTextToken;
//
//            // Set the token as an HTTP-only cookie
////            $cookie = cookie('auth_token', $token, 60 * 24 * 30, '/', config('app.url'), true, true); // 30 days expiration
//            $cookie = cookie('auth_token', $token, 6000 * 24 * 30, null, null, true, true); // 30 days expiration
//
//            // Return the redirect response with the cookie
//            return redirect()->intended('/dashboard')->withCookie($cookie);
//        }
//
//        return back()->withErrors([
//            'email' => 'The provided credentials do not match our records.',
//        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response('logged in');
        }

        return response('logged in',401);
//        return back()->withErrors([
//            'email' => 'The provided credentials do not match our records.',
//        ]);

    }

    public function registerForm()
    {
        return Inertia::render('Auth/Register', [
            'appUrl' => config('app.url')
        ]);
    }

    public function register()
    {
        (new CreateNewUser())->create(request()->all());
    }

    public function bulkInsert(Request $request, AuthService $wordsService)
    {
        return $wordsService->bulkInsert(request('content'));
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Remove the auth_token cookie
        $cookie = Cookie::forget('auth_token');

        return redirect('/')->withCookie($cookie);
    }

    public function dashboard(Request $request)
    {
        // The user is already authenticated at this point
        $user = $request->user();

        return Inertia::render('Auth/Dashboard', [
            'user' => $user->only(['id', 'name', 'email']),
        ]);
    }
}
