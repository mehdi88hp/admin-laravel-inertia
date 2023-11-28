<?php

namespace App\Scaffolder\Controllers;

use App\Scaffolder\Requests\StoreRequest;
use App\Scaffolder\Services\MainService;
use Database\Factories\UserFactory;
use Inertia\Inertia;
use Modules\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ScaffolderController
{
    public function index()
    {
        return Inertia::render('Scaffolder', [
            'appUrl' => config('app.url')
        ]);
    }

    public function test()
    {
        //1 define role and permissions
        /*        $role = Role::create(['name' => 'writer']);
        /*        $superAdminRole = Role::create(['name' => 'SuperAdmin']);
                $permission = Permission::create(['name' => 'edit articles']);*/

        //2 assign permission to a role
        /*        $role = Role::query()->where(['name' => 'writer'])->first();
                $permission = Permission::query()->where(['name' => 'edit articles'])->first();

                $role->givePermissionTo($permission);*/

        //3 assign role to a user
        /*
         *
         ///        User::factory()->count(2)->create();
        //        $user = UserFactory::new()->create();
                // @var User $user
                $user = User::query()->first();
                $user->assignRole('writer');
        //        $user->assignRole('SuperAdmin');

        //        $user->role
                $permissionNames = $user->getRoleNames(); // collection of name strings
                dd($permissionNames);
                */


        return Inertia::render('test', [
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
