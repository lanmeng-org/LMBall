<?php

// 后端路由
Route::group([
    'middleware' => ['admin.auth', 'rbac'],
    'prefix'     => env('SITE_ADMIN_PATH'),
], function (){
    Route::resource('domain', 'DomainController');
});
