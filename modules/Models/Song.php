<?php

namespace Modules\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $guarded = ['id'];

    public function words()
    {
        return $this->belongsToMany(Word::class);
    }
}
