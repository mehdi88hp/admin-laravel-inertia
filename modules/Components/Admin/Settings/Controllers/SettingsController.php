<?php

namespace Modules\Components\Admin\Settings\Controllers;


use Inertia\Inertia;
use Modules\Models\Setting;

class SettingsController
{
    public $generalSettings = [
        'siteName' => ['label' => 'site name', 'value' => ''],
        'canonical' => ['label' => 'canonical', 'value' => ''],
        'favIcon' => ['label' => 'page fav icon', 'value' => ''],
    ];

    public function index()
    {
        foreach ($this->generalSettings as $key => $generalSetting) {
            $this->generalSettings[$key]['value'] = Setting::get($key);
        }
        return Inertia::render('Settings/Index', [
            'appUrl' => config('app.url'),
            'generalSettings' => $this->generalSettings
        ]);
    }

    public function store()
    {
        foreach ($this->generalSettings as $key => $generalSetting) {
            Setting::set($key, request('generalSettings')[$key]['value']);
        }
        Setting::save();
    }
}
