<?php

namespace Modules\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

    public function books(): MorphToMany
    {
        return $this->morphedByMany(Book::class, 'item','item_categories');
    }
}
