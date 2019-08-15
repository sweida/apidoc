<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// 版本号
Route::get('/version', function() {
    return ["name" => "laravel-blog-api", "author" => "sweida", "version" => "v2"];
});

Route::namespace('Api')->prefix('v2')->group(function () {
    Route::post('/signup','UserController@signup')->name('users.signup');
    Route::post('/login','UserController@login')->name('users.login');
    // 管理员登录
    Route::middleware('adminLogin')->group(function () {
        Route::post('/admin/login', 'UserController@login')->name('users.adminlogin');
    });
    //当前用户信息
    Route::middleware('api.refresh')->group(function () {
        Route::post('/logout', 'UserController@logout')->name('users.logout');
        Route::get('/user/info','UserController@info')->name('users.info');
        Route::post('/user','UserController@show')->name('users.show');
        Route::post('/user/resetpassword','UserController@resetpassword')->name('users.resetpassword');
    });
    Route::post('/user/send_email','CommonController@send_email')->name('users.send_email');
    Route::post('/user/check_captcha','CommonController@check_captcha')->name('users.check_captcha');
    
    Route::middleware(['api.refresh', 'adminRole'])->group(function () {
        Route::post('/user/list','UserController@list')->name('users.list');
    });

    // 图片上传又拍云
    Route::middleware(['api.refresh', 'adminRole'])->group(function () {
        Route::post('/image/upload', 'ImageController@upload')->name('image.upload');
        Route::post('/image/delete', 'ImageController@delete')->name('image.delete');
    });





    // 图片广告模块
    Route::post('/ad/list', 'AdController@list')->name('ad.list');
    Route::post('/ad', 'AdController@show')->name('ad.show');
    Route::middleware(['api.refresh', 'adminRole'])->group(function () {
        Route::post('/ad/add', 'AdController@add')->name('ad.add');
        Route::post('/ad/edit', 'AdController@edit')->name('ad.edit');
        Route::post('/ad/delete','AdController@delete')->name('ad.delete');
        Route::post('/webinfo/set', 'WebinfoController@set')->name('webinfo.set');
    });

    // api文档
    Route::post('/apidoc/add', 'ApidocController@add')->name('Apidoc.add');
    Route::post('/apidoc/edit', 'ApidocController@edit')->name('Apidoc.edit');
    Route::post('/apidoc/delete', 'ApidocController@delete')->name('Apidoc.delete');
    Route::post('/apidoc/restored', 'ApidocController@restored')->name('Apidoc.restored');
    Route::get('/apidoc/list', 'ApidocController@list')->name('Apidoc.list');
    Route::post('/apidoc/deleteList', 'ApidocController@deleteList')->name('Apidoc.deleteList');
    Route::post('/apidoc/query', 'ApidocController@query')->name('Apidoc.query');
    Route::get('/apidoc/person', 'ApidocController@person')->name('Apidoc.person');
});

