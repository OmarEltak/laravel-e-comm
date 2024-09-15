<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Session;
use Intervention\Image\Facades\Image;
use App\Models\Section;
use File;

class CategoryController extends Controller
{
    public function categories()
    {
        Session::put('page', 'categories');
        $categories = Category::with('section', 'parentcategory')->get();

        return view('admin.categories.categories')->with(compact('categories'));
    }

    public function updateCategoryStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $status = ($data['status'] == "Active") ? 0 : 1;
            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }

    public function addEditCategory(Request $request, $id = null)
    {
        $title = $id ? "Edit Category" : "Add Category";
        $category = $id ? Category::find($id) : new Category;
        $getCategories = [];

        if ($id) {
            $getCategories = Category::with('subcategories')
                ->where(['parent_id' => 0, 'section_id' => $category->section_id])
                ->get();
        } else {
            $category->status = 1;
        }

        $getSections = Section::all();

        if ($request->isMethod('post')) {
            $data = $request->all();
            
            $rules = [
                'parent_id' => 'integer|nullable',
                'section_id' => 'required|integer',
                'category_name' => 'required|string|max:255',
                'category_discount' => 'nullable|numeric',
                'description' => 'nullable|string',
                'url' => 'required|string|max:255',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                'meta_keywords' => 'nullable|string',
                'status' => 'nullable|integer',
                'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
            

            $request->validate($rules);

            if ($request->hasFile('category_image')) {
                $image_tmp = $request->file('category_image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'admin/images/category_image/' . $imageName;
                    $image_tmp->move(public_path('admin/images/category_image'), $imageName);
                    
                    // Delete old image if exists
                    if ($category->category_image && $category->category_image !== 'default.jpg') {
                        $oldImagePath = public_path('admin/images/category_image/' . $category->category_image);
                        if (File::exists($oldImagePath)) {
                            File::delete($oldImagePath);
                        }
                    }
                    
                    $category->category_image = $imageName;
                }
            } else {
                // Set to 'default.jpg' or maintain existing image if no new image is uploaded
                if (!$category->exists) {
                    $category->category_image = 'default.jpg';
                }
            }
            

            $category->parent_id = $data['parent_id'] ?? null;
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'] ?? '0';
            $category->description = $data['description'] ?? '';
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'] ?? '';
            $category->meta_description = $data['meta_description'] ?? '';
            $category->meta_keywords = $data['meta_keywords'] ?? '';
            $category->status = $data['status'] ?? 1;

            $category->save();

            $request->session()->forget('_old_input');
            return redirect()->route('categories.index')->with('success', 'Category saved successfully.');
        }

        return view('admin.categories.add_edit_category', compact('title', 'category', 'getCategories', 'getSections'));
    }
  // ... (existing code)



    

    public function appendCategoryLevel(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $getCategories = Category::with('subcategories')
                ->where(['section_id' => $data['section_id'], 'parent_id' => 0, 'status' => 1])
                ->get();

            return view('admin.categories.append_categories_level')->with(compact('getCategories'));
        }
    }
    public function deleteCategory($id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);

        // Check if the category has an image and delete it if it's not the default
        if (!empty($category->category_image) && $category->category_image !== 'default.jpg') {
            $imagePath = public_path('admin/images/category_image/' . $category->category_image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete the category
        $category->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Category deleted successfully');
    }
    public function deleteCategoryImage($id)
{
    // Find the category by ID
    $category = Category::findOrFail($id);

    // Check if the category has an image and delete it if it's not the default
    if (!empty($category->category_image) && $category->category_image !== 'default.jpg') {
        $imagePath = public_path('admin/images/category_image/' . $category->category_image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Remove the image filename from the category record
        $category->category_image = null;
        $category->save();
    }

    // Redirect back with success message
    return redirect()->back()->with('success', 'Category image deleted successfully');
}


    
}
