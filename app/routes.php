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

/*Route::get('/', function()
{
	return View::make('pages.home');
});


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

    Route::get('/', function() {
        return View::make('backend.pages.home');
    });

    Route::get('/categorias', function() {
        return 'The Colour of Magic';
    });
   
    Route::get('/noticias', function() {
        return 'Reaper Man';
    });

});