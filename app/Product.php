<?php

namespace App;

class Product extends BaseModel
{
    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
