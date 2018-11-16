<?php
/**
 * 获取当前路由命名
 */
if(! function_exists('route_class')){
    function route_class()
    {
        return str_replace('.', '-', Route::currentRouteName());
    }
}