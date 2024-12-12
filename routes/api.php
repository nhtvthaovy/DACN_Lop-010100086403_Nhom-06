<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });





Route::middleware(['web', 'auth:admin', 'role:admin,owner,moderator'])->group(function () {
    Route::post('/add-category-product', [ApiController::class, 'saveCategoryProduct']);
    Route::post('/update-category-product/{id}', [ApiController::class, 'updateCategoryProduct']);

    Route::post('/delete-category-product/{category_product_id}', [ApiController::class, 'delete_category_product']);

    Route::post('/delete-product', [ApiController::class, 'deleteProduct']);


    Route::get('/categories', [ApiController::class, 'getAllCategories']);
});

Route::get('/shop', [ApiController::class, 'shop']);

Route::get('/orders/{customerId}', [ApiController::class, 'getCustomerOrders']);

Route::get('/details_orders/{orderId}', [ApiController::class, 'DetailsOrders']);

Route::post('/get-products-by-ids', [ApiController::class, 'getProductsByIds']);
