<?php

HTML::macro('clever_linkPanel', function($route) {
    $url = Request::path();
    if( $url == $route ) {
        $active = 'list-group-item active';
    }
    else {
        $active = 'list-group-item';
    }
    return $active;
});

Route::get("panel", ['as' => 'index', 'uses' => 'UserController@viewLogin']);
Route::post('panel', ['as' => 'login', 'uses' => 'UserController@login']);

Route::resource('panel/categorias', 'CategoriasController');
Route::resource('panel/productos', 'ProductosController');


Route::get('panel/logout', ['as' => 'logout', 'uses' => 'UserController@logout']);
