<?php

namespace App;

class Purchase extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function factor()
    {
        return $this->belongsTo(Factor::class);
    }
}
