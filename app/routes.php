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
Route::model('directorate', 'Directorate');
Route::model('banner', 'Banner');
Route::model('banner_detail', 'BannerDetail');
Route::model('category', 'Category');
Route::model('parent_category', 'Category');
Route::model('directory_publication', 'DirectoryPublication');
Route::model('theme_day', 'ThemeDay');


/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('post', '[0-9]+');
Route::pattern('post_id', '[0-9]+');
Route::pattern('category', '[0-9]+');
Route::pattern('parent_category', '[0-9]+');
Route::pattern('directorate', '[0-9]+');
Route::pattern('directory_publication', '[0-9]+');
Route::pattern('directory_path', '[a-z]+');
Route::pattern('theme_day', '[a-z]+');
Route::pattern('slug', '[a-z0-9-]+');
Route::pattern('slug_category', '[a-z0-9-]+');
Route::pattern('keyword', '[a-zaA-Z0-9-\s]+');
Route::pattern('type_post', '[a-z]+');
Route::pattern('page', '[0-9]+');

Route::group(array('prefix' => 'backend'), function()
{

    View::share('sidebar', Helpers::sidebarBackend());

    Route::group(array('before' => 'auth_admin'), function()
    {

        Route::get('/', function() {
        return View::make('backend.pages.home');
        });

        /******Registro de Notas********/
        Route::get('/publicaciones/{type_post}', array('as' => 'backend.post.list', 'uses' => 'AdminNewsController@listNews' ));
        Route::get('/publicacion/{type_post}/{post}/editar/', array('as' => 'backend.register.edit', 'uses' => 'AdminNewsController@news' ));
        Route::post('/publicacion/{type_post}/{post}/editar', array('as' => 'backend.register.save.edit', 'uses' => 'AdminNewsController@saveNews' ));
        Route::post('/publicacion/{post}/eliminar', array('as' => 'backend.post.delete', 'uses' => 'AdminNewsController@deletePost' ));
        Route::get('/publicaciones/{type_post}/nuevo', array('as' => 'backend.register.new', 'uses' => 'AdminNewsController@news' ));
        Route::post('/publicaciones/{type_post}/nuevo', array('as' => 'backend.register.save.new', 'uses' => 'AdminNewsController@saveNews' ));
        Route::post('/publicaciones/nota/{post}/galeria/guardar', array('as' => 'backend.register.save.gallery', 'uses' => 'AdminNewsController@saveNewsGallery' ));
        Route::get('/publicaciones/{post}/destacar', array('as' => 'backend.register.featured', 'uses' => 'AdminNewsController@newsFeatured' ));
        Route::post('/publicaciones/{post}/destacar', array('as' => 'backend.register.save.featured', 'uses' => 'AdminNewsController@saveFeatured' ));
        Route::get('/fotos', array('as' => 'backend.fotos.list', 'uses' => 'AdminPhotosController@listPhotosUser'));
        Route::post('/fotos/guardar', array('as' => 'backend.fotos.save', 'uses' => 'AdminPhotosController@savePhoto'));


        /*******Registro de categorias*******/
        Route::get('/categorias', array('as' => 'list_categories', 'uses' => 'AdminCategoryController@listCategories' ));
        Route::get('/subcategoria/{parent_category}/{category}/editar/', array('as' => 'register_subcategory', 'uses' => 'AdminCategoryController@registerCategory' ));
        Route::post('/subcategoria/{parent_category}/{category}/editar/', array('as' => 'save_category', 'uses' => 'AdminCategoryController@saveCategory' ));
        Route::get('/categoria/{category}/editar/', array('as' => 'register_category', 'uses' => 'AdminCategoryController@registerCategory' ));
        Route::post('/categoria/{category}/editar/', array('as' => 'save_category_parent', 'uses' => 'AdminCategoryController@saveCategory' ));
        Route::get('/categoria/nuevo/', array('as' => 'register_category_new', 'uses' => 'AdminCategoryController@registerCategory' ));
        Route::post('/categoria/nuevo/', array('as' => 'save_category_new', 'uses' => 'AdminCategoryController@saveCategory' ));
        Route::get('/categoria/{category}/nuevo/', array('as' => 'register_parent_category_new', 'uses' => 'AdminCategoryController@registerNewCategory' ));
        Route::post('/categoria/{category}/nuevo/', array('as' => 'save_parent_category_new', 'uses' => 'AdminCategoryController@saveCategory' ));

        /*******Registro Directorio*******/

        Route::get('/directorio/{directorate}/{slug?}', array('as' => 'backend.directory.list', 'uses' => 'AdminDirectoryController@listDirectoryPublications' ));
        Route::get('/directorio/{directorate}/{slug?}/{directory_publication}/editar', array('as' => 'backend.directory.edit', 'uses' => 'AdminDirectoryController@directoryPublicationEdit' ));
        Route::post('/directorio/{directorate}/{slug?}/{directory_publication}/editar', array('as' => 'backend.directory.save_edit', 'uses' => 'AdminDirectoryController@directoryPublicationSave' ));
        Route::get('/directorio/{directorate}/{slug?}/nuevo', array('as' => 'backend.directory.new', 'uses' => 'AdminDirectoryController@directoryPublicationEdit' ));
        Route::post('/directorio/{directorate}/{slug?}/nuevo', array('as' => 'backend.directory.save_new', 'uses' => 'AdminDirectoryController@directoryPublicationSave' ));
        Route::post('/directorio/{directorate}/{slug?}/{directory_publication}/guardar_imagen', array('as' => 'backend.directory.save_images', 'uses' => 'AdminDirectoryController@directoryPublicationImageSave' ));


        /*******Banners*******/

        Route::get('/banners', array('as' => 'backend.banner.list', 'uses' => 'AdminBannerController@listBanners' ));
        Route::get('/banners/registrar/{banner?}', array('as' => 'backend.banner.register', 'uses' => 'AdminBannerController@bannerRegister' ));
        Route::post('/banners/registrar/{banner?}', array('as' => 'backend.banner.save', 'uses' => 'AdminBannerController@bannerSave' ));
        Route::get('/detalle_banners', array('as' => 'backend.banner_detail.list', 'uses' => 'AdminBannerController@listBannersDetail' ));
        Route::post('/detalle_banners', array('as' => 'backend.banner_detail.list_search', 'uses' => 'AdminBannerController@listBannersDetail' ));
        Route::get('/detalle_banners/registrar/{banner_detail?}', array('as' => 'backend.banner_detail.register', 'uses' => 'AdminBannerController@bannerDetailRegister' ));
        Route::post('/detalle_banners/registrar/{banner_detail?}', array('as' => 'backend.banner_detail.register', 'uses' => 'AdminBannerController@bannerDetailSave' ));
        Route::post('/detalle_banners/cambiar_estado/{banner_detail}', array('as' => 'backend.banner_detail.change_status', 'uses' => 'AdminBannerController@changeStatusBannerDetail' ));
        Route::post('/detalle_banners/eliminar/{banner_detail}', array('as' => 'backend.banner_detail.delete', 'uses' => 'AdminBannerController@deleteBannerDetail' ));

        /*******Estadisticas*******/
        Route::any('/estadisticas/noticias', array('as' => 'backend.statistics_news.list', 'uses' => 'AdminStatisticsController@statisticsNews' ));
        Route::any('/estadisticas/redactores', array('as' => 'backend.statistics_redactores.list', 'uses' => 'AdminStatisticsController@statisticsRedactores' ));
        Route::any('/estadisticas/categorias', array('as' => 'backend.statistics_categorias.list', 'uses' => 'AdminStatisticsController@statisticsCategories' ));


        /*******Temas del día*******/
        Route::get('/temas_del_dia', array('as' => 'backend.theme_day.list', 'uses' => 'AdminThemeDayController@listThemeDay' ));
        Route::get('/temas_del_dia/nuevo', array('as' => 'backend.theme_day.register_new', 'uses' => 'AdminThemeDayController@registerThemeDay' ));
        Route::post('/temas_del_dia/nuevo', array('as' => 'backend.theme_day.save_new', 'uses' => 'AdminThemeDayController@saveRegisterThemeDay' ));

        /*******Autocompletar de categorias*******/
        Route::post('/autocompletar_categoria', array('as' => 'autocomplete_category', 'uses' => 'AdminNewsController@autoCompleteCategory' ));
        Route::get('/autocompletar_tag', array('as' => 'autocomplete.tag', 'uses' => 'AdminNewsController@autoCompleteTags' ));

        /*******Subir y cortar imagenes*******/
        Route::post('/upload_file_gallery',array('as'=>'upload','uses'=>'UploadController@uploadGallery'));
        Route::post('/upload_file',array('as'=>'upload','uses'=>'UploadController@uploadImagePrincipal'));
        Route::post('/upload_file_category',array('as'=>'upload','uses'=>'UploadController@uploadImageCategory'));

        Route::post('/upload_file_image/{directory_path}',array('as'=>'upload_file_image','uses'=>'UploadController@uploadImages'));
        Route::post('/cortar_imagen',array('as'=>'crop_image','uses'=>'UploadController@cropImage'));

        Route::get('/elfinder', 'Barryvdh\Elfinder\ElfinderController@showIndex');
        Route::any('/elfinder/connector', 'Barryvdh\Elfinder\ElfinderController@showConnector');
        Route::get('/elfinder/tinymce', 'Barryvdh\Elfinder\ElfinderController@showTinyMCE4');

    });

    Route::get('/login', 'UserController@loginBackend');
    Route::post('/login', 'UserController@signinBackend');
    Route::get('/logout', 'UserController@logout');

});

Route::get('/', array('as' => 'home', 'uses' => 'FrontendHomeController@home' ));
Route::get('/noticias', array('as' => 'frontend.post.more_news', 'uses' => 'FrontendHomeController@viewMoreNews' ));
Route::get('/noticias/page/{page}', array('as' => 'frontend.post.more_news_paginate', 'uses' => 'FrontendHomeController@viewMoreNews' ));
Route::any('/noticias/buscar/{keyword?}', array('as' => 'frontend.post.search', 'uses' => 'FrontendSectionController@searchPost' ));
Route::any('/noticias/buscar/{keyword?}/{page}', array('as' => 'frontend.post.search.pagination', 'uses' => 'FrontendSectionController@searchPost' ));

Route::get('/N{id}', array('as' => 'frontend.show_url_post', 'uses' => 'FrontendSectionController@shortUrlPosting' ));

Route::get('/radio', array('as' => 'frontend.radio', 'uses' => 'FrontendSectionController@radio' ));

Route::get('/sitemap', array('as' => 'sitemap', 'uses' => 'SitemapsController@index' ));
Route::get('/sitemap-netjoven.xml', array('as' => 'sitemap.netjoven', 'uses' => 'SitemapsController@netjoven' ));
Route::get('/sitemap-noticias.xml', array('as' => 'sitemap.news', 'uses' => 'SitemapsController@news' ));
Route::get('/sitemap-news.xml', array('as' => 'sitemap.news.tag', 'uses' => 'SitemapsController@newsTag' ));

Route::get('/juerga/{directory_publication}/{slug}.html', array('as' => 'frontend.juerga.view', 'uses' => 'FrontendSectionController@viewDirectoryPublication' ));
Route::get('/juerga/{args?}/{page?}', array('as' => 'frontend.juerga.list', 'uses' => 'FrontendSectionController@listDirectorate' ))->where('args', '(.*)');
Route::get('/pichanga/{directory_publication}/{slug}.html', array('as' => 'frontend.pichanga.view', 'uses' => 'FrontendSectionController@viewDirectoryPublication' ));
Route::get('/pichanga/{args?}/{page?}', array('as' => 'frontend.pichanga.list', 'uses' => 'FrontendSectionController@listDirectorate' ))->where('args', '(.*)');

Route::get('{slug}', array('as' => 'frontend.section.list', 'uses' => 'FrontendSectionController@listSection' ));
Route::get('{slug}/{page}', array('as' => 'frontend.section.pagination', 'uses' => 'FrontendSectionController@listSection' ));
Route::get('{slug_category}/{post_id}/{slug}.html', array('as' => 'frontend.post.view', 'uses' => 'FrontendSectionController@viewPost' ));
Route::get('/tag/{keyword?}', array('as' => 'frontend.post.tags', 'uses' => 'FrontendSectionController@searchTag' ));
Route::get('/tag/{keyword?}/{page}', array('as' => 'frontend.post.tags.pagination', 'uses' => 'FrontendSectionController@searchTag' ));
Route::get('/{slug_category}/{keyword?}', array('as' => 'frontend.post.redirect_tags', 'uses' => 'FrontendSectionController@redirectTag' ));


Route::get('/iniciar_sesion', array('as' => 'frontend.login', 'uses' => 'UserController@login' ));
Route::post('/iniciar_sesion', array('as' => 'frontend.login.post', 'uses' => 'UserController@signin' ));
Route::get('/registrate.html', array('as' => 'frontend.user.register', 'uses' => 'UserController@userRegister' ));
Route::post('/registrate.html', array('as' => 'frontend.user.save_register', 'uses' => 'UserController@saveUserProfile' ));
Route::get('/edita_tu_perfil.html', array('as' => 'frontend.user.edit_perfil', 'uses' => 'UserController@editPerfilUser' ));
Route::post('/edita_tu_perfil.html', array('as' => 'frontend.user.save_edit_perfil', 'uses' => 'UserController@saveUserProfile' ));
Route::post('/load_province.html', array('as' => 'frontend.user.load_province', 'uses' => 'UserController@loadProvince' ));
Route::post('/load_city.html', array('as' => 'frontend.user.load_city', 'uses' => 'UserController@loadCity' ));
Route::post('/upload_image_user.html',array('as'=>'upload_file_image_user','uses'=>'UploadController@uploadPhotoPerfil'));

Route::get('/iniciar_sesion_fb', array('as' => 'frontend.login.facebook', 'uses' => 'UserController@loginFacebook' ));
Route::get('/iniciar_sesion_tw', array('as' => 'frontend.login.twitter', 'uses' => 'UserController@loginTwitter' ));
Route::get('/cerrar_sesion', array('as' => 'frontend.login.close_session', 'uses' => 'UserController@logout' ));

Route::get('/cambiar_color', array('as' => 'frontend.user.tools.changecolor', 'uses' => 'FrontendUserToolsController@viewChangeColor' ));
Route::post('/cambiar_color', array('as' => 'frontend.user.tools.savechangecolor', 'uses' => 'FrontendUserToolsController@saveChangeColor' ));
Route::get('/cambiar_tipo_vista/{type_module}', array('as' => 'frontend.change_view', 'uses' => 'FrontendUserToolsController@changeTypeModule' ));
Route::post('/cambiar_tipo_vista/{type_module}', array('as' => 'frontend.save.change_view', 'uses' => 'FrontendUserToolsController@saveTypeModule' ));
Route::get('/galeria_imagenes/{post}', array('as' => 'frontend.post.gallery', 'uses' => 'FrontendSectionController@viewPostGallery' ));
