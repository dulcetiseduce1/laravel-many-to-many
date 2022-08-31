<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::middleware("auth")
  ->namespace("Admin") // indica la cartella dove si trovano i controller
  ->name("admin.") // Aggiungie prima del nome di ogni rotta questo prefisso
  ->prefix("admin") // Aggiunge prima di ogni URI questo pregisso
  ->group(function () {
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('/test', 'HomeController@test')->name('test');
    // Route::get('/posts/create', 'HomeController@test')->name('posts.create');
    // Route::get('/posts/{post}/edit', 'HomeController@test')->name('posts.edit');

    Route::get("/users", "UserController@index")->name("users.index");
    Route::patch("/users/{user}", "UserController@update")->name("users.update");
    Route::get("/users/{user}/edit", "UserController@edit")->name("users.edit");
    
    Route::get("/categories/{category}/posts", "CategoryController@posts")->name("categories.posts");

    Route::resource("posts", "PostController");
  });

/* Route::middleware("auth")->get('/admin', 'Admin\HomeController@index')->name('admin.index');
Route::get('/admin/test', 'Admin\HomeController@test')->name('admin.test');
Route::get('/admin/posts/create', 'Admin\HomeController@test')->name('admin.posts.create');
Route::get('/admin/posts/{post}/edit', 'Admin\HomeController@test')->name('admin.posts.edit'); */