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

/*Route::get('/', function () {
    return view('welcome');
});*/


Schema::defaultStringLength(191);


Route::get('/','WelcomeController@loadHome');
Route::get('/portfolio','WelcomeController@loadPortfolio');


Route::get('/admin','SuperAdminController@loadAdmin');



//Route::get('/dashboard','SuperAdminController@loadDashboard');

Route::put('/admin_login','SuperAdminController@adminLogin');


Route::get('/dashboard','SuperAdminController@loadDashboard');


Route::get('/logout','SuperAdminController@logout');



Route::get('/add_category','SuperAdminController@add_category');

Route::post('/add_category_form','SuperAdminController@add_category_form');
Route::post('/update_category_form','SuperAdminController@updateCategory_form');
Route::post('/update_blog_form','SuperAdminController@updateBlog_form');
Route::post('/add_post_form','SuperAdminController@addPost_form');
Route::post('/add_comments','WelcomeController@addComments');


Route::get('/manage_category','SuperAdminController@manageCategory');

Route::get('/unpublish-category/{id}','SuperAdminController@unpublishCategory');
Route::get('/unpublish-blog/{id}','SuperAdminController@unpublishBlog');

Route::get('/delete-category/{id}','SuperAdminController@deleteCategory');
Route::get('/delete-blog/{id}','SuperAdminController@deleteBlog');

Route::get('/edit-category/{id}','SuperAdminController@editCategory');
Route::get('/edit-blog/{id}','SuperAdminController@editBlog');
Route::get('/edit-category2/{id}','SuperAdminController@editCategory2');


Route::get('/add-blog','SuperAdminController@addBlog');
Route::get('/manage-blog','SuperAdminController@manageBlog');



Route::get('/detail_post/{id}','WelcomeController@detailPost');
Route::get('/category_post_show/{id}','WelcomeController@categoryPostShow');
Route::get('/popular_post_show/','WelcomeController@popularPpostSshow');






/*Route::get( '/url' , 'which_blade_file_should_load' );*/