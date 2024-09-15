<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Front\CartController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/admin')->namespace('Admin')->group(function () {
    Route::match(['get', 'post'], '/login',[App\Http\Controllers\Admin\AdminController::class, 'login'])->name('admin.login');

    Route::group(['middleware' => ['admin']], function () {

        Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/settings', [App\Http\Controllers\Admin\AdminController::class, 'settings'])->name('admin.admin_settings');
        // Route::get('settings', 'Admin\AdminController@settings');
        Route::get('logout', 'Admin\AdminController@logout')->name('admin.logout');;
        // Route::post('check-current-pwd', 'Admin\AdminController@chkCurrentPassword');
        Route::post('/check-current-pwd', [App\Http\Controllers\Admin\AdminController::class, 'chkCurrentPassword'])->name('admin.chkCurrentPassword');
        Route::post('/update-current-pwd', [App\Http\Controllers\Admin\AdminController::class, 'updateCurrentPassword'])->name('admin.updateCurrentPassword');
        Route::match(['get', 'post'], 'update-admin-details',[App\Http\Controllers\Admin\AdminController::class, 'updateAdminDetails'])->name('admin.updateAdminDetails');

        // Sections
        Route::get('/sections', [App\Http\Controllers\Admin\SectionController::class, 'sections'])->name('admin.sections');
        Route::post('/update-section-status', [App\Http\Controllers\Admin\SectionController::class, 'updateSectionStatus'])->name('admin.updateSectionStatus');
        Route::match(['get', 'post'], '/add-edit-section/{id?}', [App\Http\Controllers\Admin\sectionController::class, 'addEditSection'])->name('admin.addEditSection');
        Route::get('/admin/sections', [App\Http\Controllers\Admin\SectionController::class, 'sections'])->name('sections.index');

        // Categories
        Route::get('/categories', [App\Http\Controllers\Admin\CategoryController::class, 'categories'])->name('admin.categories');
        Route::post('/update-category-status', [App\Http\Controllers\Admin\CategoryController::class, 'updateCategoryStatus'])->name('admin.updateCategoryStatus');
        Route::match(['get', 'post'], '/add-edit-category/{id?}', [App\Http\Controllers\Admin\CategoryController::class, 'addEditCategory'])->name('admin.addEditCategory');
        Route::get('/categories', [App\Http\Controllers\Admin\CategoryController::class, 'categories'])->name('categories.index');
        // Route to delete category image
        Route::delete('/add-edit-category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'deleteCategoryImage'])->name('admin.deleteCategoryImage');
        // Route for deleting a category
        Route::delete('/delete-category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'deleteCategory'])->name('categories.delete');
        
        Route::post('/append-categories-level', [App\Http\Controllers\Admin\CategoryController::class, 'appendCategoryLevel'])->name('admin.appendCategoryLevel');
        
        
        // Products
        Route::get('/products', [App\Http\Controllers\Admin\ProductsController::class, 'products'])->name('admin.products');
        Route::post('/update-product-status', [App\Http\Controllers\Admin\ProductsController::class, 'updateProductStatus'])->name('admin.updateProductStatus');
        Route::delete('/delete-product/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'deleteProduct'])->name('products.delete');
        Route::match(['get', 'post'], '/add-edit-product/{id?}', [App\Http\Controllers\Admin\ProductsController::class, 'addEditProduct'])->name('admin.addEditProduct');
        // Route to delete product image
        Route::delete('/add-edit-product/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'deleteProductImage'])->name('admin.deleteProductImage');

        // Attributes
        Route::match(['get', 'post'], '/add-attributes/{id?}', [App\Http\Controllers\Admin\ProductsController::class, 'addAttributes'])->name('admin.addAttributes');

        // Images
        Route::match(['get', 'post'], '/add-images/{id?}', [App\Http\Controllers\Admin\ProductsController::class, 'addImages'])->name('admin.addImages');
        




    });
});

// problem f product image not displayed but it reads it with dd and data base

// Frontend
Route::prefix('/front')->namespace('Front')->group(function () {
    Route::get('/', [App\Http\Controllers\Front\indexController::class, 'index'])->name('frontend.index');
    Route::get('/shop', [App\Http\Controllers\Front\indexController::class, 'shop'])->name('frontend.shop');
    Route::get('/products/{id}', [App\Http\Controllers\Front\indexController::class, 'products'])->name('frontend.products');
    Route::get('/shop_details/{id}', [App\Http\Controllers\Front\indexController::class, 'shop_details'])->name('frontend.shop_details');
    Route::get('/fetch-sku', [App\Http\Controllers\Front\indexController::class, 'fetchSku'])->name('fetch.sku');
    // frontend 2
    Route::get('/home_page', [App\Http\Controllers\Front\homepageController::class, 'homePage'])->name('frontend.homepage');


    // Cart
    Route::middleware('auth')->group(function () {
        Route::get('cart', [App\Http\Controllers\Front\CartController::class, 'show'])->name('cart.show');
        Route::post('cart/update', [App\Http\Controllers\Front\CartController::class, 'update'])->name('cart.update');
        Route::post('/cart/remove', [App\Http\Controllers\Front\CartController::class, 'remove'])->name('cart.remove');
        Route::post('cart/checkout', [App\Http\Controllers\Front\CartController::class, 'checkout'])->name('cart.checkout');
        Route::post('/cart/add', [App\Http\Controllers\Front\CartController::class, 'addToCart'])->name('cart.add');

    });
});








