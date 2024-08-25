<?php

namespace Modules\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Genre extends Model
{
    protected $guarded = [];

    use NodeTrait;

    public function parent()
    {
       return $this->belongsTo(Genre::class);
    }
}
