<?php

namespace App;


class Category extends BaseModel
{
    public function products()
    {
        return  $this->belongsToMany(Product::class);
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class,'category_id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
