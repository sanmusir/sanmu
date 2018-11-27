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
        //删除话题的时候，删除相关收藏记录
        Favorite::where('topic_id',$topic->id)->delete();
        \DB::table('replies')->where('topic_id', $topic->id)->delete();
    }

}