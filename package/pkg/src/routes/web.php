<?php

use Illuminate\Support\Facades\Route;

use Vinh\Pkg\Http\Controllers\HomeController;

use Vinh\Pkg\Http\Controllers\AdminController;

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

Route::get('/', [HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('vinh.pkg.dashboard');
    })->name('dashboard');
});

//Route for classifying the admin page and the other pages
Route::get('/redirect', [HomeController::class, 'redirect']);

//Route for admin page
//Route for viewing category
Route::get('/view_category', [AdminController::class, 'view_category']);

//Route for adding category to the website
Route::post('/add_category', [AdminController::class, 'add_category']);

//Route for deleting the category
Route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);

//Route for showing the page for admin add the products
Route::get('/view_product', [AdminController::class, 'view_product']);

//Route not showing directly, when submit, the product will store in database
Route::post('/add_product', [AdminController::class, 'add_product']);

//Route for showing all products, can delete or edit the infomations of the products
Route::get('/show_product', [AdminController::class, 'show_product']);

//Route not showing directly, when press delete button, the product will remove from database
Route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);

//Route for showing the page for changing the informations of the products
Route::get('/update_product/{id}', [AdminController::class, 'update_product']);

//Route not showing directly, when pressing edit button, the new informations that are changed will store in database
Route::post('/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm']);

Route::get('/order', [AdminController::class, 'order']);

Route::get('/delivered/{id}', [AdminController::class, 'delivered']);

Route::get('/search', [AdminController::class, 'searchdata']);


//----------------------------------------------------------------------

//Route for user page
//Route for showing the page of details of the products
Route::get('/product_details/{id}', [HomeController::class, 'product_details']);

//Route not showing directly, when press add to cart button, the goods will store to the cart table
Route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);

//Route for showing the page of the cart of the customer
Route::get('/show_cart', [HomeController::class, 'show_cart']);

//Route not showing directly, when press remove cart button, the product will remove from cart database
Route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart']);

//Route not showing directly, when press cash on delivery button, the data from cart table will move to order table
Route::get('/cash_order', [HomeController::class, 'cash_order']);

//Route for showing all orders if the users
Route::get('/show_order', [HomeController::class, 'show_order']);


Route::get('/cancel_order/{id}', [HomeController::class, 'cancel_order']);

?>