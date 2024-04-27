<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//register from vue
Route::post('/register', [ApiController::class, 'register']);

//login from vue
Route::post('/login', [ApiController::class, 'login']);

//get all product
Route::get('/product', [ApiController::class, 'product']);

//get all category
Route::get('/category', [ApiController::class, 'category']);

//get search category
Route::post('/category/search', [ApiController::class, 'categorySearch']);

//get search Product
Route::post('/product/search', [ApiController::class, 'productSearch']);

//get user profile
Route::post('/profile', [ApiController::class, 'profile']);

//update user profile
Route::post('/updateProfile', [ApiController::class, 'updateProfile']);

//upload user image
Route::post('/uploadImage', [ApiController::class, 'uploadImage']);

//details product
Route::post('/product/details', [ApiController::class, 'details']);

Route::post('/product/viewCount', [ApiController::class, 'viewCount']);

//get all cart
Route::post('/cart', [ApiController::class, 'cart']);

//get all pending order
Route::post('/order', [ApiController::class, 'order']);


//add cart
Route::post('/addCart', [ApiController::class, 'addCart']);

// get  cart for cart page
Route::post('/cartPage', [ApiController::class, 'cartPage']);

// get  order for order page 
Route::post('/orderPage', [ApiController::class, 'orderPage']);


//receive order list from vue
Route::post('/addOrder', [ApiController::class, 'addOrder']);

//contact
Route::post('/contact', [ApiController::class, 'contact']);

// xxx //
//test api for pagination
Route::get('/product/paginate', [ApiController::class, 'productPaginate']);