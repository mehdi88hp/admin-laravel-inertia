<?php

namespace App\Scaffolder\Controllers;

use App\Scaffolder\Requests\StoreRequest;
use App\Scaffolder\Services\MainService;
use Inertia\Inertia;

class ScaffolderController
{
    public function index()
    {
        return Inertia::render('Scaffolder', [
            'appUrl' => config('app.url')
        ]);
    }

    public function store(StoreRequest $request)
    {
        (new MainService)
            ->setFields($request->fields)
            ->setComponentName($request->componentName)
            ->createComponent();

        return 'ok';
    }
}
