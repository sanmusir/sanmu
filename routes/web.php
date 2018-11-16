<?php
Route::get('/', 'PagesController@root')->name('root');
//注册页面
Route::get('signup', 'UsersController@create')->name('signup');