<?php

namespace App\Observers;

use App\Models\User;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    public function creating(User $user)
    {
        //
    }

    public function updating(User $user)
    {
        //
    }

    public function saving(User $user)
    {
        if (empty($user->avatar)) {
            $user->avatar = 'https://iocaffcdn.phphub.org/uploads/images/201710/30/1/TrJS40Ey5k.png';
        }
    }


    public function deleted(User $user)
    {
        //删除用户回复
        \DB::table('replies')->where('user_id', $user->id)->delete();
        //删除用户话题
        \DB::table('topics')->where('user_id', $user->id)->delete();
        //删除用户收藏
        \DB::table('favorites')->where('user_id', $user->id)->delete();
    }
}