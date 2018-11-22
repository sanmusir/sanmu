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

/**
 * 根据文章获取摘要信息
 */
if(! function_exists('make_excerpt')){
    function make_excerpt($value, $length = 200)
    {
        $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
        return str_limit($excerpt, $length);
    }
}