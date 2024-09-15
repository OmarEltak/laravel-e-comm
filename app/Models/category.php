<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Define the relationship between Category and Product
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function subcategories(){
        return $this->hasMany(Category::class, 'parent_id')->where('status',1);
    }

    public function section(){
        return $this->belongsTo(Section::class, 'section_id')->select('id', 'section_name');
    }

    public function parentcategory(){
        return $this->belongsTo(Category::class, 'parent_id')->select('id', 'category_name');
    }
}
