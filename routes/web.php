<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\Landing\LandingController::class, 'index'])->name('home');
Route::get('/shop/{categorySlug?}', [\App\Http\Controllers\Landing\ShopController::class, 'index'])->name('shop');
Route::get('/product-detail/{slug}', [\App\Http\Controllers\Landing\ShopController::class, 'product_detail'])->name('product.detail');
Route::post('/product/{productId}/review', [\App\Http\Controllers\Landing\ShopController::class, 'storeReview'])->name('product.review');
Route::view('/about', 'landing-page.about')->name('about');
Route::view('/contact', 'landing-page.contact')->name('contact');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/cart', [\App\Http\Controllers\Landing\CartController::class, 'cart'])->name('cart');
    Route::post('/add-to-cart', [\App\Http\Controllers\Landing\CartController::class, 'addCart'])->name('addCart');
    Route::post('/update-cart', [\App\Http\Controllers\Landing\CartController::class, 'updateCart'])->name('updateCart');
    Route::post('/delete-cart', [\App\Http\Controllers\Landing\CartController::class, 'deleteCart'])->name('deleteCart');
    Route::post('/apply-discount', [\App\Http\Controllers\Landing\CartController::class, 'applyDiscount'])->name('applyDiscount');
    Route::post('/remove-discount', [\App\Http\Controllers\Landing\CartController::class, 'removeDiscount'])->name('removeDiscount');
    Route::get('/checkout', [\App\Http\Controllers\Landing\CartController::class, 'checkout'])->name('checkout');
    Route::post('/save-customer', [\App\Http\Controllers\Landing\CartController::class, 'saveCustomer'])->name('saveCustomer');
    Route::post('/procces-checkout', [\App\Http\Controllers\Landing\CartController::class, 'proccesCheckout'])->name('proccesCheckout');
    Route::get('/success', [\App\Http\Controllers\Landing\CartController::class, 'success'])->name('success');
    Route::get('/wishlist', [\App\Http\Controllers\Landing\WishlistController::class, 'index'])->name('wishlist');
    Route::post('/add-wishlist', [\App\Http\Controllers\Landing\WishlistController::class, 'addWishlist'])->name('addWishlist');
    Route::delete('/remove-wishlist', [\App\Http\Controllers\Landing\WishlistController::class, 'removeWishlist'])->name('removeWishlist');
    Route::delete('/clear-wishlist', [\App\Http\Controllers\Landing\WishlistController::class, 'clearWishlist'])->name('clearWishlist');
});

Route::group(['prefix' => 'account'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', [\App\Http\Controllers\Landing\AuthController::class, 'login'])->name('account.login');
        Route::post('/auth', [\App\Http\Controllers\Landing\AuthController::class, 'auth'])->name('account.auth');
        Route::get('/register', [\App\Http\Controllers\Landing\AuthController::class, 'register'])->name('account.register');
        Route::post('/storeRegister', [\App\Http\Controllers\Landing\AuthController::class, 'storeRegister'])->name('account.storeRegister');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/logout', [\App\Http\Controllers\Landing\AuthController::class, 'logout'])->name('account.logout');
        Route::get('/profile', [\App\Http\Controllers\Landing\AuthController::class, 'profile'])->name('account.profile');
        Route::post('/update-profile', [\App\Http\Controllers\Landing\AuthController::class, 'updateProfile'])->name('account.updateProfile');
        Route::get('/orders', [\App\Http\Controllers\Landing\AuthController::class, 'orders'])->name('account.orders');
        Route::get('/address', [\App\Http\Controllers\Landing\AuthController::class, 'address'])->name('account.address');
        Route::get('/order-detail/{id}', [\App\Http\Controllers\Landing\AuthController::class, 'orderDetail'])->name('account.orderDetail');
    });
});

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('admin.login');
        Route::post('/auth', [\App\Http\Controllers\AuthController::class, 'auth'])->name('admin.auth');
    });

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [\App\Http\Controllers\DashboardController::class, 'logout'])->name('admin.logout');

        Route::resource('product-categories', \App\Http\Controllers\ProductCategoriesController::class)->except(['show']);
        Route::resource('product', \App\Http\Controllers\ProductController::class);
        Route::resource('discount', \App\Http\Controllers\DiscountController::class);
        Route::resource('customer', \App\Http\Controllers\CustomerController::class);
        Route::resource('order', \App\Http\Controllers\OrderController::class)->only('index', 'edit', 'update');
        Route::resource('product-review', \App\Http\Controllers\ProductReviewController::class);
        Route::resource('user', \App\Http\Controllers\UserController::class);
    });
});
