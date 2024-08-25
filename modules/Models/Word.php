<?php

namespace Modules\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $guarded = ['id'];

    /**
     * Get TourRequest files base path
     *
     * @return \Illuminate\Config\Repository|\Illuminate\Foundation\Application|mixed
     */
    public static function filesBasePath()
    {
        return config('general.default_files_path');
    }

    /**
     * Get directory path which contains all tour request related files
     *
     * @return string
     */
    public function filesPath()
    {
        return static::filesBasePath() . DIRECTORY_SEPARATOR . $this->id;
    }
}
