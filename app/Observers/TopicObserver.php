<?php

namespace App\Observers;

use App\Models\Topic;
use App\Models\Favorite;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{

    public function saving(Topic $topic)
    {
        //xss过滤
        $topic->body = clean($topic->body, 'user_topic_body');
        //生成摘要
        $topic->excerpt = make_excerpt($topic->body);
    }

    public function deleted(Topic $topic)
    {
        //删除收藏
        \DB::table('favorites')->where('topic_id', $topic->id)->delete();
        //删除回复
        \DB::table('replies')->where('topic_id', $topic->id)->delete();
    }

}