<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Session;
use App\Models\Section;
use App\Models\Category; 
use App\Models\ProductsAttribute;
use App\Models\Attribute;
use App\Models\ProductsImage;
use image;



class ProductsController extends Controller
{
    public function products()
    {
        Session::put('page', 'products');
        $products = Product::with('category', 'section')->get();

        return view('admin.products.products')->with(compact('products'));
    }
    
    

    public function updateProductStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $status = ($data['status'] == "Active") ? 0 : 1;
            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }

    public function deleteProduct($id)
    {
        // Find the Product by ID
        $product = Product::findOrFail($id);

        // Check if the Product has an image and delete it if it's not the default
        if (!empty($product->product_image) && $product->product_image !== 'default.jpg') {
            $imagePath = public_path('admin/images/product_image/' . $product->product_image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete the Product
        $product->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Product deleted successfully');
    }

    public function addEditProduct(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Product";
            $product = new Product;
        } else {
            $title = "Edit Product";
            $product = Product::findOrFail($id); // Ensure you fetch the existing product
        }
    
        if ($request->isMethod('post')) {
            $data = $request->all();
    
            $rules = [
                'category_id' => 'required|integer',
                'product_name' => 'required|string|max:255',
                'product_code' => 'required|max:255',
                'product_price' => 'required|numeric',
                'product_color' => 'required|max:255',
                'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
    
            $customMessages = [
                'category_id.required' => 'Category is required.',
                'product_name.required' => 'Product name is required.',
                'product_name.string' => 'Valid product name is required.',
                'product_name.max' => 'Product name should not exceed 255 characters.',
                'product_code.required' => 'Product code is required.',
                'product_price.required' => 'Product price is required.',
                'product_price.numeric' => 'Valid product price is required.',
                'product_color.required' => 'Product Color is required.',
                'main_image.image' => 'Main Image must be an image file.',
                'main_image.mimes' => 'Main Image must be of type: jpeg, png, jpg, gif, svg.',
                'main_image.max' => 'Main Image size should not exceed 2048KB.',
            ];
    
            $this->validate($request, $rules, $customMessages);
    
            // Handle file upload for main_image
            if ($request->hasFile('main_image')) {
                $image = $request->file('main_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/admin_images/product_images/small'), $imageName);
                $product->main_image = $imageName;
            }
            
    
            // Set default values for optional fields
            $product->product_video = $data['product_video'] ?? null;
            $product->is_featured = $data['is_featured'] ?? 'No'; // 'No' as default
            $product->fabric = $data['fabric'] ?? null;
            $product->pattern = $data['pattern'] ?? null;
            $product->sleeve = $data['sleeve'] ?? null;
            $product->fit = $data['fit'] ?? null;
            $product->occasion = $data['occasion'] ?? null;
            $product->meta_title = $data['meta_title'] ?? null;
            $product->meta_keywords = $data['meta_keywords'] ?? null;
            $product->meta_description = $data['meta_description'] ?? null;
            $product->product_weight = $data['product_weight'] ?? null;
    
            // Save product details
            $categoryDetails = Category::find($data['category_id']);
            $product->section_id = $categoryDetails->section_id;
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_discount = $data['product_discount'] ?? 0;
            $product->description = $data['description'] ?? null;
            $product->product_price = $data['product_price'];
            $product->pattern = $data['pattern'] ?? null;
            $product->fabric = $data['fabric'] ?? null;
            $product->product_weight = $data['product_weight'] ?? null;
            $product->sleeve = $data['sleeve'] ?? null;
            $product->fit = $data['fit'] ?? null;
            $product->occasion = $data['occasion'] ?? null;
            $product->meta_title = $data['meta_title'] ?? null;
            $product->meta_keywords = $data['meta_keywords'] ?? null;
            $product->meta_description = $data['meta_description'] ?? null;
            $product->is_featured = $data['is_featured'] ?? 'No'; // Ensure is_featured is assigned correctly
            $product->status = 1; // Default to active status
            $product->url = $data['url'];
                // Handle is_featured checkbox
    $product->is_featured = $request->has('is_featured') ? 'Yes' : 'No';

    // Handle product video
    if ($request->hasFile('product_video')) {
        $video = $request->file('product_video');
        $videoName = time() . '.' . $video->getClientOriginalExtension();
        $video->move(public_path('videos/product_videos'), $videoName);
        $product->product_video = $videoName;
    }

            $product->save();
            Session::flash('success', 'Product added successfully');
            return redirect()->route('admin.products');
        }
    
        // Filter arrays for form options
        $fabricArray = ['Cotton', 'Polyester', 'Wool'];
        $sleeveArray = ['Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleeveless'];
        $patternArray = ['Checked', 'Plain', 'Printed', 'Self', 'Solid'];
        $fitArray = ['Regular', 'Slim'];
        $occasionArray = ['Casual', 'Formal'];
    
        // Sections with categories and subcategories
        $categories = Section::with('categories')->get();
    
        return view('admin.products.add_edit_product', compact('title', 'product', 'fabricArray', 'sleeveArray', 'patternArray', 'fitArray', 'occasionArray', 'categories'));
    }
    
    public function addAttributes(Request $request, $id) {
        if ($request->isMethod('POST')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            foreach ($data['sku'] as $key => $value){
                if(!empty($value)){
                    // Sku already exists
                    $attrCountSKU = ProductsAttribute::where('sku', $value)->count();
                    if ($attrCountSKU > 0) {
                        return redirect()->back()->withErrors(['SKU: ' . $value . ' already exists. Please enter a unique SKU.']);
                    }
                    // Size already exists
                    $attrCountSize = ProductsAttribute::where(['product_id'=>$id, 'size'=>$data['size'][$key]])->count();
                    if ($attrCountSize > 0) {
                        return redirect()->back()->withErrors(['Size: ' . $value . ' already exists. Please enter a unique Size.']);
                    }
                    $attribute = new ProductsAttribute;
                    $attribute->Product_id = $id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();
                }
            }
            Session::flash('success', 'Product Attributes added successfully');
        }

        $productdata = Product::with('attributes')->find($id);
        $title = "Add Attributes";
        $categories = Section::with('categories')->get();

        return view('admin.products.add_attributes')->with(compact('title', 'productdata'));
    }


    public function addImages(Request $request, $id = null)
    {
        // Check if ID is provided and validate
        if ($id) {
            $product = Product::find($id);
    
            if (!$product) {
                return redirect()->back()->withErrors('Product not found');
            }
        } else {
            return redirect()->back()->withErrors('Product ID is required');
        }
    
        if ($request->isMethod('POST')) {
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    // Validate image
                    $request->validate([
                        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ]);
    
                    try {
                        $productImage = new ProductsImage;
    
                        // Use the Image facade to process the image
                        $img = Image::make($image);
                        $extension = $image->getClientOriginalExtension();
                        $imageName = rand(111, 999999) . time() . "." . $extension;
    
                        // Save the image to the desired directory
                        $img->save(public_path('images/admin_images/product_images/' . $imageName));
    
                        // Save image information to the database
                        $productImage->image = $imageName;
                        $productImage->product_id = $id; // Ensure this ID exists in the products table
                        $productImage->save();
                    } catch (\Exception $e) {
                        return redirect()->back()->withErrors('Failed to upload image: ' . $e->getMessage());
                    }
                }
    
                // Redirect back with a success message
                return redirect()->back()->with('success', 'Images added successfully');
            } else {
                return redirect()->back()->withErrors('No images were uploaded');
            }
        }
    
        $productdata = Product::with('images')->find($id);
        $title = "Product Images";
        return view('admin.products.add_images')->with(compact('productdata', 'title'));
    }
    
    
    
    
    
    
    
}
