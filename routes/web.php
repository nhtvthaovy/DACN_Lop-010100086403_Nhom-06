<?php

use App\Exports\CategoryProductExport;
use App\Exports\ProductExport;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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


//Frontend
Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/home', 'App\Http\Controllers\HomeController@index');
Route::get('/shop', 'App\Http\Controllers\HomeController@shop');
Route::post('/search', 'App\Http\Controllers\HomeController@search');


// Danh mục sản phẩm
Route::get('/category-product/{category_id}', 'App\Http\Controllers\CategoryController@show_category_shop');


// Sản phẩm
Route::get('/product-detail/{product_id}', 'App\Http\Controllers\ProductController@details_product_shop');
Route::post('/submit-review', 'App\Http\Controllers\ReviewController@submit_review');



//Cart
Route::get('/show-cart', 'App\Http\Controllers\CartController@show_cart');
Route::post('/add-cart', 'App\Http\Controllers\CartController@add_cart');
Route::post('/update-cart', 'App\Http\Controllers\CartController@update_cart');
Route::get('/delete-pro-cart/{session_id}', 'App\Http\Controllers\CartController@delete_pro_cart');

//Checkout
Route::get('/login-checkout', 'App\Http\Controllers\CheckoutController@login_checkout');
Route::get('/logout-checkout', 'App\Http\Controllers\CheckoutController@logout_checkout');
Route::post('/login-customer', 'App\Http\Controllers\CheckoutController@login_customer');

Route::get('/sign-customer', 'App\Http\Controllers\CheckoutController@sign_customer');
Route::post('/add-customer', 'App\Http\Controllers\CheckoutController@add_customer');
Route::get('/checkout-payment', 'App\Http\Controllers\CheckoutController@checkout_payment');
Route::post('/save-checkout-customer-payment', 'App\Http\Controllers\CheckoutController@save_checkout_customer_payment');


// Thanh toán
Route::get('/thank-handcash/{orderid}', 'App\Http\Controllers\CheckoutController@thank_handcash');

// Route::get('/thank-vnpay/{orderid}', 'App\Http\Controllers\CheckoutController@thank_vnpay');
// Route::post('/vnpay-payment', 'App\Http\Controllers\CheckoutController@vnpay_payment');

Route::get('/momo-o', 'App\Http\Controllers\CheckoutController@momo_o');


Route::get('/order', 'App\Http\Controllers\CheckoutController@order');
Route::post('/orderid', 'App\Http\Controllers\CheckoutController@orderid');

Route::get('/account', 'App\Http\Controllers\CustomerController@account');
Route::post('/customer/account/update', [CustomerController::class, 'updateAccount'])->name('customer.update');


Route::get('/thank-momo/{orderid}', 'App\Http\Controllers\CheckoutController@thank_momo');
Route::post('/momo-payment', 'App\Http\Controllers\CheckoutController@momo_payment');


//Backend

// send mail
Route::get('/send-mail', 'App\Http\Controllers\HomeController@send_mail');


// admin
Route::get('/admin', 'App\Http\Controllers\AuthController@index')->name('login');
Route::get('/register-auth', 'App\Http\Controllers\AuthController@register_auth');
Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::post('/login', 'App\Http\Controllers\AuthController@login');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@show_dashboard');

// Route::get('/add-user', 'App\Http\Controllers\AuthController@add_user');
// Route::post('/create-user', 'App\Http\Controllers\AuthController@create_user');

// Route::get('/all-user', 'App\Http\Controllers\AuthController@all_user');

// Route::post('/update-role/{user_id}', 'App\Http\Controllers\AuthController@update_role');
// Route::get('/delete-user/{user_id}', 'App\Http\Controllers\AuthController@delete_user');

Route::middleware(['auth:admin', 'role:admin,owner,moderator'])->group(function () {

    //Category Product
    Route::get('/add-category-product', 'App\Http\Controllers\CategoryController@add_category_product');
    Route::get('/edit-category-product/{category_product_id}', 'App\Http\Controllers\CategoryController@edit_category_product');
    // Route::get('/delete-category-product/{category_product_id}', 'App\Http\Controllers\CategoryController@delete_category_product');
    Route::get('/all-category-product', 'App\Http\Controllers\CategoryController@all_category_product');

    Route::get('/active-category-product/{category_product_id}', 'App\Http\Controllers\CategoryController@active_category_product');
    Route::get('/unactive-category-product/{category_product_id}', 'App\Http\Controllers\CategoryController@unactive_category_product');

    // Route::post('/save-category-product', 'App\Http\Controllers\CategoryController@save_category_product');
    // Route::post('/update-category-product/{category_product_id}', 'App\Http\Controllers\CategoryController@update_category_product');

    Route::post('/import-category-product', [CategoryController::class, 'importCategoryProduct'])->name('import.category.product');


    Route::get('export-category', function () {
        $time = Carbon::now()->format('Y-m-d_H-i-s');
        $filename = 'danh_muc_san_pham_' . $time . '.xlsx';
    
        return Excel::download(new CategoryProductExport, $filename);
    });

    

    Route::get('export-products', function () {
        return Excel::download(new ProductExport, 'products_' . now()->format('Y_m_d_H_i_s') . '.xlsx');
    });

    //Product
    Route::get('/add-product', 'App\Http\Controllers\ProductController@add_product');
    Route::get('/edit-product/{product_id}', 'App\Http\Controllers\ProductController@edit_product');
    Route::get('/delete-product/{product_id}', 'App\Http\Controllers\ProductController@delete_product');
    Route::get('/all-product', 'App\Http\Controllers\ProductController@all_product');
    Route::post('/add-img', 'App\Http\Controllers\ProductController@add_img');

    // Route xóa ảnh
    Route::post('/delete-image/{image}', [ProductController::class, 'deleteImage'])->name('delete.image');




    Route::get('/import-product', 'App\Http\Controllers\ProductController@import_product');

    Route::post('/import-product', [ProductController::class, 'importProduct']);


    Route::get('/active-product/{product_id}', 'App\Http\Controllers\ProductController@active_product');
    Route::get('/unactive-product/{product_id}', 'App\Http\Controllers\ProductController@unactive_product');

    Route::post('/save-product', 'App\Http\Controllers\ProductController@save_product');
    Route::post('/update-product/{product_id}', 'App\Http\Controllers\ProductController@update_product');
    

    ///
    
    Route::get('/manage-review', 'App\Http\Controllers\ReviewController@manage_review');
    Route::get('/active-review/{review_id}', 'App\Http\Controllers\ReviewController@active_review');
    Route::get('/unactive-review/{review_id}', 'App\Http\Controllers\ReviewController@unactive_review');

    Route::get('delete-review/{review_id}', [ReviewController::class, 'deleteReview'])->name('delete.review');


    Route::post('/add-reply', [ReviewController::class, 'addReply'])->name('addReply');


    Route::put('/reply/{id}', [ReviewController::class, 'updateReply'])->name('updateReply');
    Route::delete('/reply/{id}', [ReviewController::class, 'deleteReply'])->name('deleteReply');





});
Route::middleware(['auth:admin', 'role:admin,owner'])->group(function () {

    Route::get('/manage-order', 'App\Http\Controllers\CheckoutController@manage_order');
    Route::get('/view-order/{orderid}', 'App\Http\Controllers\CheckoutController@view_order');
    Route::post('/status-order/{orderid}', 'App\Http\Controllers\CheckoutController@status_order');

    Route::post('status-payment/{orderid}', 'App\Http\Controllers\CheckoutController@updatePaymentStatus');



    Route::get('/add-user', 'App\Http\Controllers\AuthController@add_user');
    Route::post('/create-user', 'App\Http\Controllers\AuthController@create_user');
    Route::get('/all-user', 'App\Http\Controllers\AuthController@all_user');
    Route::post('/update-role/{user_id}', 'App\Http\Controllers\AuthController@update_role');
    Route::get('/delete-user/{user_id}', 'App\Http\Controllers\AuthController@delete_user');

    Route::get('edit-user/{id}', 'App\Http\Controllers\AuthController@edit_user');
    Route::post('update-user/{id}', 'App\Http\Controllers\AuthController@update_user');


Route::get('/manage', 'App\Http\Controllers\AuthController@manage')->name('admin.manage');


});