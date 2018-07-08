<?php

Route::get('/', ['as' => 'homepage', 'uses' => 'DefaultController@indexAction']);

Route::get('/images/{path}', ['uses' => 'ImageController@showAction', 'as' => 'show_image'])
    ->where('path', '.*');

Route::any('/cikis-yap', ['as' => 'auth_logout', 'uses' => 'Auth\LoginController@logoutAction']);
