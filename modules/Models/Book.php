<?php

namespace Modules\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
//    protected $guarded = ['id'];
    protected $fillable = ['title', 'content', 'path'];

    public function genres()
    {
        return $this->morphToMany(Genre::class,'item','item_genres');
    }

    public function bookSection()
    {
        return $this->hasMany(BookSection::class);
    }
//    public function words()
//    {
//        return $this->belongsToMany(Word::class);
//    }
}
