<?php
Route::get('/', 'TopicsController@index')->name('root');
//注册页面
Route::get('signup', 'UsersController@create')->name('signup');
//用户相关
Route::get('/users/create', 'UsersController@create')->name('users.create');
Route::post('/users', 'UsersController@store')->name('users.store');
Route::get('/users/{user}', 'UsersController@show')->name('users.show');
Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
//会话相关
Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::post('logout', 'SessionsController@destroy')->name('logout');
//邮箱认证
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');
//密码重设
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::resource('topics', 'TopicsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
//话题分类
Route::resource('categories','CategoriesController',['only'=>['show']]);
//收藏相关
Route::post('favorite/{topic}', 'TopicsController@favoritePost');
Route::post('unfavorite/{topic}', 'TopicsController@unFavoritePost');
Route::get('my_favorites', 'UsersController@myFavorites');
//图片上传
Route::post('upload_image','TopicsController@uploadImage')->name('topics.upload_image');
Route::resource('replies', 'RepliesController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);