<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; // Use the Product model
use App\Models\category;
use App\Models\section;
use App\Models\ProductsAttribute; // Import the model here



class indexController extends Controller
{
    public function index(){
        return view('front.index');
    }

    public function shop_details($id)
    {
        $product = Product::findOrFail($id);
        
        // Fetch sizes for the given product
        $sizes = ProductsAttribute::where('product_id', $id)
            ->whereNotNull('size')
            ->get();
        
        // Fetch unique color options for the product
        $colors = Product::where('id', $id)->pluck('product_color')->unique();
    
        // Fetch base SKU (before size is selected)
        $product_attributes = ProductsAttribute::where('product_id', $id)->first(); 
        $sku = $product_attributes ? $product_attributes->sku : 'SKU not available'; // Default SKU
        
        return view('front.shop_details', compact('product', 'sizes', 'colors', 'sku'));
    }
    
    
    public function fetchSku(Request $request)
    {
        $size = $request->input('size');
    
        // Fetch the product attribute (assuming the base SKU is the same for all sizes)
        $productAttribute = ProductsAttribute::whereNotNull('sku')->first();
    
        // Append the size to the SKU
        if ($productAttribute) {
            return response()->json([
                'sku' => $productAttribute->sku . '-' . strtoupper($size)
            ]);
        } else {
            return response()->json([
                'sku' => 'SKU not available'
            ]);
        }
    }
    
    
    
    
    
    

    



    public function shop(Request $request)
    {

        $sections = Section::withCount('categories')->get();
        $categories = Category::withCount('products')->get();
        $colors = Product::select('product_color')->distinct()->pluck('product_color')->toArray();
        // Base query to fetch products
        $query = Product::where('status', 1);
        
        // Filter by section
        if ($request->has('section_id')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('section_id', $request->section_id);
            });
        }
        // Filter by category
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        
        // Filter by product color
        if ($request->has('color')) {
            $query->where('product_color', $request->color);
        }
        
        // Filter by price range
        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween('product_price', [$request->min_price, $request->max_price]);
        }
    
        // Sort by price
        if ($request->has('sort_price')) {
            if ($request->sort_price == 'low_high') {
                $query->orderBy('product_price', 'asc');
            } elseif ($request->sort_price == 'high_low') {
                $query->orderBy('product_price', 'desc');
            }
        }
    
        // Fetch the filtered products and paginate
        $products = $query->paginate(12);
        
        return view('front.shop', compact('sections', 'categories', 'products', 'colors'));
    }
    
    
    
    
    
    
    
}
