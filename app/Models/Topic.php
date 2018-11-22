<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'excerpt', 'slug'];

    //话题所属分类
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //话题所属用户
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWithOrder($query, $order)
    {
        switch ($order) {
            case 'hot':              //最热话题
                $query->hot();
                break;
            case 'recent':           //最新创建
                $query->recent();
                break;
            default:
                $query->recentReplied();
                break;
        }
        return $query->with('user', 'category');
    }

    public function scopeRecentReplied($query)
    {
        // 按照更新时间排序
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeHot($query)
    {
        // 按照热度排序
        return $query->orderBy('view_count', 'desc');
    }

}
