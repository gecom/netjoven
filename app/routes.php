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


/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('post', '[0-9]+');



Route::get('/', function()
{
	return View::make('frontend.pages.home');
});

/*
Route::controller('install_netjoven', 'InstallController');


Route::get('about', function()
{
	return View::make('pages.about');
});
Route::get('projects', function()
{
	return View::make('pages.projects');
});
Route::get('contact', function()
{
	return View::make('pages.contact');
});*/



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

        Route::post('/autocompletar_categoria', array('as' => 'autocomplete_category', 'uses' => 'AdminNewsController@autoCompleteCategory' ));
        Route::post('/upload_file_gallery',array('as'=>'upload','uses'=>'UploadController@uploadGallery'));     
        Route::post('/upload_file',array('as'=>'upload','uses'=>'UploadController@uploadImagePrincipal'));    
        Route::post('/cortar_imagen',array('as'=>'upload','uses'=>'UploadController@cropImage'));
    });

    Route::get('/login', 'UserController@login');
    Route::post('/login', 'UserController@signin');
    Route::get('/logout', 'UserController@logout');

});