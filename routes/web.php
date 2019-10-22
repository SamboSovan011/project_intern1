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
// Route User

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Route::post('/signup', ['as' => 'SignUp', 'uses' => 'HomeController@SignUp']);
// Route::post('/login', ['as' => 'Login', 'uses' => 'HomeController@Login']);
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/checkEmail', ['as' => 'checkEmail', 'uses' => 'checkEmailController@checkEmailAvailable']);
// View Profile
Route::get('/userprofile', ['as' => 'userprofile', 'uses' => 'HomeController@showUserProfile']);
Route::post('/updateProfile/{id}', ['as' => 'updateProfile', 'uses' => 'HomeController@updateProfile']);


// Route admin
Route::get('/admin/login', 'AdminController@showadminloginform');
Route::post('/admin', ['as' => 'adminlogin', 'uses' => 'AdminController@login']);
Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
Route::prefix('/admin/dashboard')->group(function(){
    // Route slide
    Route::get('/slidelisting', ['as' => 'slidelisting', 'uses' => 'ListingController@slideListing']);
    Route::get('/slide', ['as' => 'slide', 'uses' => 'ListingController@slideForm']);
    Route::post('/postSlide', ['as'=>'postSlide', 'uses' => 'ListingController@postSlide']);
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
    //Route listingUser
    Route::get('/listingUser', ['as' => 'listingUser', 'uses' => 'ListingController@listingUser']);
    Route::get('/add_admin/{id}', ['as' => 'add_admin', 'uses' => 'ListingController@add_admin']);
    Route::get('/add_user/{id}', ['as' => 'add_user', 'uses' => 'ListingController@add_user']);
    Route::get('/block_user/{id}', ['as' => 'block_user', 'uses' => 'ListingController@block_user']);
    Route::get('/delete_user/{id}', ['as' => 'delete_user', 'uses' => 'ListingController@delete_user']);
    Route::get('/getUserData/{id}', 'ListingController@getUserdata')->name('getUserData');
    Route::post('/editUser/{id}', ['as' => 'editUser', 'uses' => 'ListingController@editUser']);
    //Route Post products
    Route::resource('post', 'PostController');
    Route::get('/editpost/{id}', 'PostController@getdata')->name('getpostdata');
    Route::post('/updatepost/{id}', 'PostController@updatepost')->name('update.post');
});

