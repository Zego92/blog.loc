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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::get('/', 'HomeController@index')->name('home');
Route::get('posts', 'PostController@index')->name('post.index');
Route::get('post/{slug}', 'PostController@details')->name('post.details');
Route::get('/category/{slug}', 'PostController@postByCategory')->name('category.posts');
Route::get('/tag/{slug}', 'PostController@postByTag')->name('tag.posts');
Route::get('/contact', 'HomeController@contact')->name('contact');


Route::post('subscriber', 'SubscriberController@store')->name('subscriber.store');

Route::get('/search', 'SearchController@search')->name('search');

Auth::routes();
Route::group(['middleware' => ['auth']], function (){
    Route::post('favorite/{post}/add', 'FavoriteController@add')->name('post.favorite');
    Route::post('comment/{post}', 'CommentController@store')->name('comment.store');
});
Route::group(['as' => 'admin', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function (){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');
    Route::resource('tag', 'TagController');
    Route::resource('category', 'CategoryController');
    Route::get('/favorite', 'FavoriteController@index')->name('favorite.index');
    Route::get('comments', 'CommentController@index')->name('comment.index');
    Route::delete('comments/{id}', 'CommentController@destroy')->name('comment.destroy');
    Route::get('subscriber', 'SubscriberController@index')->name('subscriber.index');
    Route::delete('subscriber/{subscriber}', 'SubscriberController@destroy')->name('subscriber.destroy');
    Route::resource('post', 'PostController');
});

Route::group(['as' => 'author','prefix' => 'author', 'namespace' => 'Author', 'middleware' => ['auth', 'author']], function (){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
});

View::composer('layouts.front.partial.footer', function ($view){
    $categories = App\Category::all();
    $view->with('categories', $categories);
});
