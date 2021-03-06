<?php

use Illuminate\Support\Facades\Config;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/* admin pages */


Route::group(['middleware' => ['web', 'auth']], function ($router) {
    $router->group(['prefix' => Config::get('copya.admin_path'), 'namespace' => 'Admin',], function($router){

        $router->group(['prefix' => 'categories'], function($router){
            $router->get('/', 'CategoriesController@index')->name('categories.index');
        });

    });
});


