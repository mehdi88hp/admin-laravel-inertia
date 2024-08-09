<?php

namespace Modules\Components\Admin\Auth\Controllers;


use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Modules\Components\Admin\Auth\Services\AuthService;

class AuthController
{
    public function login()
    {
        return Inertia::render('Auth/Login', [
            'appUrl' => config('app.url')
        ]);
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

}
