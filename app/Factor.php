<?php

namespace App;

class Factor extends BaseModel
{
    public function products()
    {
        return $this->hasManyThrough(Product::class, Purchase::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
