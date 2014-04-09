<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('post', 'Post');
Route::model('category', 'Category');
Route::model('parent_category', 'Category');


/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('post', '[0-9]+');
Route::pattern('category', '[0-9]+');
Route::pattern('parent_category', '[0-9]+');


View::share('dbl_categories_home', Helpers::getCategoriesHome());

Route::get('/', array('as' => 'home', 'uses' => 'FrontEndHomeController@home' ));




Route::group(array('prefix' => 'backend'), function()
{

    View::share('sidebar', Helpers::sidebarBackend());

    Route::group(array('before' => 'auth_admin'), function()
    {

        Route::get('/', function() {
        return View::make('backend.pages.home');
        });


        Route::get('/publicaciones', array('as' => 'list_post', 'uses' => 'AdminNewsController@listNews' ));
        Route::get('/publicaciones/nota/{post}/editar/', array('as' => 'regiter_post_edit', 'uses' => 'AdminNewsController@news' ));
        Route::post('/publicaciones/nota/{post}/editar', array('as' => 'save_news_edit', 'uses' => 'AdminNewsController@saveNews' ));
        Route::get('/publicaciones/nota/nuevo', array('as' => 'regiter_post_new', 'uses' => 'AdminNewsController@news' ));
        Route::post('/publicaciones/nota/nuevo', array('as' => 'save_news_create', 'uses' => 'AdminNewsController@saveNews' ));

        Route::get('/categorias', array('as' => 'list_categories', 'uses' => 'AdminCategoryController@listCategories' ));

        Route::get('/subcategoria/{parent_category}/{category}/editar/', array('as' => 'register_subcategory', 'uses' => 'AdminCategoryController@registerCategory' ));
        Route::post('/subcategoria/{parent_category}/{category}/editar/', array('as' => 'save_category', 'uses' => 'AdminCategoryController@saveCategory' ));
        Route::get('/categoria/{category}/editar/', array('as' => 'register_category', 'uses' => 'AdminCategoryController@registerCategory' ));
        Route::post('/categoria/{category}/editar/', array('as' => 'save_category_parent', 'uses' => 'AdminCategoryController@saveCategory' ));
        Route::get('/categoria/nuevo/', array('as' => 'register_category_new', 'uses' => 'AdminCategoryController@registerCategory' ));
        Route::post('/categoria/nuevo/', array('as' => 'save_category_new', 'uses' => 'AdminCategoryController@saveCategory' ));
        Route::get('/categoria/{category}/nuevo/', array('as' => 'register_parent_category_new', 'uses' => 'AdminCategoryController@registerNewCategory' ));
        Route::post('/categoria/{category}/nuevo/', array('as' => 'save_parent_category_new', 'uses' => 'AdminCategoryController@saveCategory' ));

        Route::post('/autocompletar_categoria', array('as' => 'autocomplete_category', 'uses' => 'AdminNewsController@autoCompleteCategory' ));
        Route::post('/upload_file_gallery',array('as'=>'upload','uses'=>'UploadController@uploadGallery'));
        Route::post('/upload_file',array('as'=>'upload','uses'=>'UploadController@uploadImagePrincipal'));
        Route::post('/upload_file_category',array('as'=>'upload','uses'=>'UploadController@uploadImageCategory'));

        Route::post('/cortar_imagen',array('as'=>'upload','uses'=>'UploadController@cropImage'));
    });

    Route::get('/login', 'UserController@login');
    Route::post('/login', 'UserController@signin');
    Route::get('/logout', 'UserController@logout');

});