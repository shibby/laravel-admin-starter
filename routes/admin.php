<?php

Route::match(['GET', 'POST'], '/admin/login', 'Admin\AuthController@loginAction')
    ->name('admin_login');
Route::match(['GET', 'POST'], '/admin/logout', 'Admin\AuthController@logoutAction')->name('admin_logout')->middleware('auth');
Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'can:editor', 'bindings']], function () {
    Route::get('/', 'Admin\DefaultController@indexAction')->name('admin_index');

    Route::group(['prefix' => '/users', 'middleware' => ['can:admin']], function () {
        Route::get('/', 'Admin\UserController@indexAction')->name('admin_user_index');
        Route::any('/form/{user?}', 'Admin\UserController@formAction')->name('admin_user_form');
        Route::any('/delete/{user}', 'Admin\UserController@deleteAction')->name('admin_user_delete');
    });
});
