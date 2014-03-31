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


        Route::get('/noticias', 'AdminNewsController@listNews');
        Route::get('/noticia/editar/{news_id}', array('as' => 'news_edit', 'uses' => 'AdminNewsController@news' ));
       
    });

    Route::get('/login', 'UserController@login');
    Route::post('/login', 'UserController@signin');
    Route::get('/logout', 'UserController@logout');

});