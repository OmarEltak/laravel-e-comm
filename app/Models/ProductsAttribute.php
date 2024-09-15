<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsAttribute extends Model
{
    use HasFactory;
    protected $table = 'products_attributes'; // Ensure this matches your table name
 
}
