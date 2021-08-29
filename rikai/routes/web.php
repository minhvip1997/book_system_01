<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController as HomePageController1;
use App\Http\Controllers\BookController as BookController1;
use App\Http\Controllers\ReviewController as ReviewController1;
use App\Http\Controllers\CommentController as CommentController1;
use App\Http\Controllers\ProfileController as ProfileController1;
use App\Http\Controllers\UserController as UserController1;
use App\Http\Controllers\CategoryController as CategoryController2;

use App\Http\Controllers\Admin\HomeController as HomeController1;
use App\Http\Controllers\Admin\BookController as BookController2;
use App\Http\Controllers\Admin\CategoryController as CategoryController1;
use App\Http\Controllers\Admin\UserController as UserController2;
use App\Http\Controllers\Admin\ProfileController as ProfileController2;
use App\Http\Controllers\Admin\CartController as CartController2;
use App\Http\Controllers\Admin\LoginController as LoginController2;
use App\Http\Controllers\Admin\ChartController as ChartController2;
use App\Http\Controllers\Admin\TagController as TagController2;

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ChangeController as ChangeController1;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
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


Route::get('/', [HomePageController1::class, 'index'])->name('index');

Route::middleware(['auth'])->group(function () {
    Route::resource('activity', ActivityController::class);
});

Route::get('language/{language}', [App\Http\Controllers\LanguageController::class, 'language'])->name('language.index');
Route::resource('review', ReviewController1::class)->only('show');
Route::resource('book', BookController1::class);
Route::resource('home', HomePageController1::class);
Route::resource('categoryuser', CategoryController2::class);
Route::resource('comment', CommentController1::class)->only('show');
Auth::routes();
Route::get('search', [BookController1::class, 'search'])->name('search');
Route::get('/redirectgoogle', 'App\Http\Controllers\Auth\LoginController@redirectToProvider')->name("login.provider");
Route::get('/callbackgoogle', 'App\Http\Controllers\Auth\LoginController@handleProviderCallback');
Route::get('/redirectfacebook', 'App\Http\Controllers\FbController@redirectToFacebook')->name("login.facebook");
Route::get('/callbackfacebook', 'App\Http\Controllers\FbController@facebookSignin');
Route::get('full-text-search',[BookController1::class, 'fulltextsearch'])->name('full.text.search');



Route::middleware(['users'])->group(function () {
    Route::get('addreview/{id}', [BookController1::class, 'addreview'])->name('add.review');
    Route::resource('review', ReviewController1::class)->except('show');
    Route::resource('profile', ProfileController1::class);
    Route::resource('comment', CommentController1::class)->except('show');
    Route::get('profile/favoritebook/{id}', [ProfileController1::class, 'favoriteBook'])->name('profile.favorite');
    Route::get('checkout', [CartController::class, 'checkout']);
    Route::get('profile/ratebook/{id}', [ProfileController1::class, 'rateBook'])->name('profile.ratebook');
    Route::get('profile/timeline/{id}', [ActivityController::class, 'show'])->name('profile.timeline');
    Route::put('change_password', [ChangeController1::class, 'changePassword'])->name('change.password');
    Route::put('change_image', [ChangeController1::class, 'changeImage'])->name('change.image');
    Route::get('listuser',[ProfileController1::class,'listuser'])->name('listuser');
    Route::get('like/review/{reviewid}',[ReviewController1::class,'likereview'])->name('like.review');
    Route::get('unlike/review/{reviewid}',[ReviewController1::class,'unlikereview'])->name('unlike.review');
    Route::get('like/comment/{commentid}',[CommentController1::class,'likecomment'])->name('like.comment');
    Route::get('unlike/comment/{commentid}',[CommentController1::class,'unlikecomment'])->name('unlike.comment');
    Route::get('latestCart', [CartController::class, 'latestCart']);
    Route::get('follow/{userid}/{followid}',[UserController1::class,'follow'])->name('follow');
    Route::get('unfollow/{userid}/{followid}',[UserController1::class,'unfollow'])->name('unfollow');
    Route::resource('timeline', ActivityController::class);
    Route::resource('cart', CartController::class);
    Route::resource('cartItem', CartItemController::class);
    Route::get('current_cart', [CartController::class, 'currentCart']);
    Route::get('cancel/{id}', [CartController::class, 'cancel']);
    Route::post('hide/{id}', [ReviewController1::class, 'hidereview'])->name('review.hide');
    Route::get('managercomment/{id}', [CommentController1::class, 'managercomment'])->name('comment.manager');
    Route::post('hidecomment/{id}', [CommentController1::class, 'hidecomment'])->name('comment.hide');
});


Route::resource('timeline', ActivityController::class);


Route::group(['prefix'=>'admin','middleware' => ['admin']], function(){
    Route::resource('homeadmin',HomeController1::class);
    Route::resource('bookadmin',BookController2::class);
    Route::resource('category',CategoryController1::class);
    Route::resource('user',UserController2::class);
    Route::resource('profileadmin',ProfileController2::class);
    Route::resource('tag', TagController2::class);
    Route::post('search/user', [UserController2::class, 'search'])->name('admin.user.search');
    Route::resource('cart',CartController2::class);
    Route::get('cart/type/{type}',[CartController2::class,'cartType'])->name('admin.cart.type');
    Route::get('buybook',[UserController2::class,'buybook']);
    Route::get('logout', [LoginController2::class, 'logout'])->name('admin.logout');
    Route::get('category/{categoryid}/delete', [CategoryController1::class, 'destroy'])->name('deletecategory');
    Route::get('book/{bookid}/delete', [BookController2::class, 'destroy'])->name('deletebook');
    Route::get('cart/{id}/delete', [CartController2::class, 'destroy'])->name('deletecart');
    Route::get('user/{id}/delete', [UserController2::class, 'destroy'])->name('deleteuser');
    Route::get('tag/{id}/delete', [TagController2::class, 'destroy'])->name('deletetag');
    Route::resource('chart',ChartController2::class)->only('index');
    Route::get('export', [ChartController2::class, 'export'])->name('chart.export');
    Route::get('exportorder', [ChartController2::class, 'exportorder'])->name('chart.exportorder');
});
Route::get('admin/login',[LoginController2::class,'index'])->name('admin.index');
Route::post('admin/login', [LoginController2::class, 'postLogin'])->name('admin.login');


    
