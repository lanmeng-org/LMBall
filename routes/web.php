<?php

Route::get('logout', function () {
    Session::flush();
});

Route::group([
    'middleware' => ['admin.auth', 'rbac'],
    'prefix'     => env('SITE_ADMIN_PATH'),
    'namespace'  => 'Admin',
    'as'         => 'admin.',
], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::group(['as' => 'rbac.', 'prefix' => 'rbac', 'namespace' => 'Rbac'], function () {
        Route::resource('permission', 'PermissionController');
        Route::resource('role', 'RoleController');
        Route::resource('user', 'UserController');
        Route::resource('route', 'RouteController');
    });

    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::put('profile', 'ProfileController@update')->name('profile.update');

    Route::resource('domain', 'DomainController');
    Route::resource('domain/{domain}/url', 'UrlController');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
});

Route::get('/{path}', 'HomeController@index')->where('path', '.*');
