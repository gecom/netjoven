<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Upload dir
    |--------------------------------------------------------------------------
    |
    | The dir where to store the images (relative from public)
    |
    */

    'dir' =>  '_files',

    /*
    |--------------------------------------------------------------------------
    | Access filter
    |--------------------------------------------------------------------------
    |
    | Filter callback to check the files
    |
    */

    'access' => 'Barryvdh\Elfinder\Elfinder::checkAccess',

    /*
    |--------------------------------------------------------------------------
    | Roots
    |--------------------------------------------------------------------------
    |
    | By default, the roots file is LocalFileSystem, with the above public dir.
    | If you want custom options, you can set your own roots below.
    |
    */

    'roots' =>  array(
                    array(
                        'driver' => 'LocalFileSystem', // driver for accessing file system (REQUIRED)
                        'path' => Config::get('settings.upload').'noticias', // path to files (REQUIRED)
                        'URL' => Config::get('settings.urlupload').'noticias' , // URL to files (REQUIRED),
                        'access' => 'Barryvdh\Elfinder\Elfinder::checkAccess'
                    )
            ),

);
