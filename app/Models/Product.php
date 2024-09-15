<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault([
            'category_name' => 'No Category',
        ]);
    }
    

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id')->withDefault([
            'section_name' => 'No Section',
        ]);
    }

    public function attributes()
    {
        return $this->hasMany(ProductsAttribute::class);
    }
    
    public function images()
    {
        return $this->hasMany(ProductsImage::class);
    }
}
