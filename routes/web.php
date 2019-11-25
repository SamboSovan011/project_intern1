<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Illuminate\Support\Facades\Route;
//Guest
Route::get('/', 'HomeController@index')->name('home.index');
// Route::post('/signup', ['as' => 'SignUp', 'uses' => 'HomeController@SignUp']);
Route::get('/product/{product}', 'HomeController@show')->name('single-products.show');
Route::get('/promotion', ['as' => 'promotionProducts', 'uses' => 'HomeController@promotionProduct']);
Route::get('/checkEmail', ['as' => 'checkEmail', 'uses' => 'checkEmailController@checkEmailAvailable']);
//Show product by category
Route::get('/category/products/{id}', 'HomeController@show_product_cats')->name('show.product-cats');
Route::get('/category/products/pro/{id}', 'HomeController@show_product_cats_pro')->name('show.product-cats-pro');
// Route::post('/login', ['as' => 'Login', 'uses' => 'HomeController@Login']);
Auth::routes(['verify' => true]);
Route::get('/logout', 'Auth\LoginController@logout');
// Route User
// View Profile
Route::group(['middleware' => ['auth', 'verified']], function () {
    // Route::post('/login', 'Auth\LoginController@login');

    Route::prefix('/user')->group(function () {
        //Route User Profile
        Route::get('/userprofile', ['as' => 'userprofile', 'uses' => 'HomeController@showUserProfile']);
        Route::post('/updateProfile/{id}', ['as' => 'updateProfile', 'uses' => 'HomeController@updateProfile']);
        //Route Review
        Route::get('/my-reviews', ['as' => 'myreviews', 'uses' => 'HomeController@getReview']);
        Route::post('/editReview/{id}', ['as' => 'editreview', 'uses' => 'HomeController@editReview']);
        Route::get('/getComment/{id}', 'HomeController@getComment')->name('getComment');
    });


    Route::post('/changePass/{id}', ['as' => 'changePass', 'uses' => 'HomeController@changePass']);

    //Route Reviews
    Route::post('/reviews', ['as' => 'reviews', 'uses' => 'ReviewController@store']);

    //Route Cart
    Route::post('/cart/add', 'ShoppingCartController@addToCart')->name('shopping.add');
    Route::get('/cart', 'ShoppingCartController@index')->name('shopping.index');
    Route::get('/cart/delete/{id}', 'ShoppingCartController@delete')->name('shopping.delete');

    //Route Checkout
    Route::group(['middleware' => 'checkout'], function () {
        Route::get('/checkout', ['as' => 'checkout', 'uses' => 'CheckoutController@checkout']);
        Route::post('/checkout', ['as' => 'checkout.store', 'uses' => 'CheckoutController@store']);
    });
});


// Dashboard
// Route admin and subadmin
Route::group(['middleware' => ['admin.auth', 'verified']], function () {
    Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    Route::prefix('/admin/dashboard')->group(function () {
        // Route slide
        Route::get('/slidelisting', ['as' => 'slidelisting', 'uses' => 'ListingController@slideListing']);
        Route::get('/slide', ['as' => 'slide', 'uses' => 'ListingController@slideForm']);
        Route::post('/postSlide', ['as' => 'postSlide', 'uses' => 'ListingController@postSlide']);
        Route::get('/deleteSlide/{id}', ['as' => 'deleteSlide', 'uses' => 'ListingController@deleteSlide']);
        Route::get('/approveSlide/{id}', ['as' => 'approveSlide', 'uses' => 'ListingController@approveSlide']);
        Route::get('/blockSlide/{id}', ['as' => 'blockSlide', 'uses' => 'ListingController@blockSlide']);
        Route::get('/getSlide/{id}', 'ListingController@getSlideData')->name('getSlideData');
        Route::post('/editSlide/{id}', ['as' => 'editSlide', 'uses' => 'ListingController@editSlide']);
        // Route category
        Route::get('/categorylisting', ['as' => 'categorylisting', 'uses' => 'ListingController@categoryListing']);
        Route::get('/newcategoryposting', ['as' => 'newcategoryposting', 'uses' => 'ListingController@categoryPostingForm']);
        Route::post('/postCategory', ['as' => 'postCategory', 'uses' => 'ListingController@postNewCategory']);
        Route::get('/approveCategory/{id}', ['as' => 'approveCategory', 'uses' => 'ListingController@approveCategory']);
        Route::get('/blockCategory{id}', ['as' => 'blockCategory', 'uses' => 'ListingController@blockCategory']);
        Route::get('/deleteCategory/{id}', ['as' => 'deleteCategory', 'uses' => 'ListingController@deleteCategory']);
        Route::get('/getCategory/{id}', 'ListingController@getCategory')->name('getCategoryData');
        Route::post('/editCategory/{id}', ['as' => 'editCategory', 'uses' => 'ListingController@editCategory']);


        //Products Order
        Route::get('/product-order', ['as' => 'productOrder', 'uses' => 'ListingController@productOrder']);
        Route::post('/deliever/{token}', ['as' => 'Deliever', 'uses' => 'ListingController@deliever']);
        Route::get('/not-deliever/{token}', ['as' => 'Not-Deliever', 'uses' => 'ListingController@notDeliever']);

        //Route Products
        Route::resource('products', 'ProductsController');
        Route::get('trash', 'ProductsController@trash')->name('products.trashed');
        Route::put('restore-product/{product}', 'ProductsController@restore')->name('products.restore');
        Route::get('/approve-products/{id}', 'ProductsController@approve')->name('products.approved');
        Route::get('/block-products/{id}', 'ProductsController@block')->name('products.block');

        //Route Promotion Products


        //Route listingUser
        Route::group(['middleware' => ['onlyadmin.auth', 'verified']], function () {
            Route::prefix('/admin-tool')->group(function () {
                //Route Send Recommend Email


                //Route Pending
                Route::get('/pending', ['as' => 'pending', 'uses' => 'ListingController@pendingListing']);
                // Pending + Checkout
                Route::post('/acceptCheckout/{token}', ['as' => 'acceptCheckout', 'uses' => 'ListingController@acceptCheckout']);
                Route::get('/cancelCheckout/{token}', ['as' => 'cancelCheckout', 'uses' => 'ListingController@cancelCheckout']);
                Route::get('/deleteCheckout/{token}', ['as' => 'deleteCheckout', 'uses' => 'ListingController@deleteCheckout']);
                Route::get('/getcheckout/{token}', 'ListingController@getCheckout')->name('getCheckout');
                // Route Review
                Route::get('/approveReview/{id}', ['as' => 'approveReview', 'uses' => 'ReviewController@approveReview']);
                Route::get('/blockReview{id}', ['as' => 'blockReview', 'uses' => 'ReviewController@blockReview']);
                Route::get('/deleteReview/{id}', ['as' => 'deleteReview', 'uses' => 'ReviewController@deleteReview']);
                Route::get('/getReview/{id}', 'ReviewController@getReview')->name('getReviewData');
                Route::post('/editReview/{id}', ['as' => 'editReview', 'uses' => 'ReviewController@editReview']);

                //  Route Trash
                Route::get('/trash-items', 'ListingController@trash')->name('trash');
                Route::put('restore-slide/{slide}', 'ListingController@restoreSlide')->name('slide.restore');
                Route::put('restore-cate/{cate}', 'ListingController@restoreCate')->name('cate.restore');
                Route::put('restore-review/{review}', 'ReviewController@restoreReview')->name('review.restore');
                Route::put('restore-invoice/{token}', 'ListingController@restoreCheckout')->name('invoice.restore');
            });
            // Route User
            Route::get('/listingUser', ['as' => 'listingUser', 'uses' => 'ListingController@listingUser']);
            Route::get('/add_admin/{id}', ['as' => 'add_admin', 'uses' => 'ListingController@add_admin']);
            Route::get('/add_subadmin/{id}', ['as' => 'add_subadmin', 'uses' => 'ListingController@add_subadmin']);
            Route::get('/add_user/{id}', ['as' => 'add_user', 'uses' => 'ListingController@add_user']);
            Route::get('/block_user/{id}', ['as' => 'block_user', 'uses' => 'ListingController@block_user']);
            Route::get('/delete_user/{id}', ['as' => 'delete_user', 'uses' => 'ListingController@delete_user']);
            Route::get('/getUserData/{id}', 'ListingController@getUserdata')->name('getUserData');
            Route::post('/editUser/{id}', ['as' => 'editUser', 'uses' => 'ListingController@editUser']);
        });
    });
});
