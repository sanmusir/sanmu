<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','introduction','avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->activation_token = str_random(30);
        });
    }

    //关联话题
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    //关联收藏
    public function favorites()
    {
        return $this->belongsToMany(Topic::class, 'favorites', 'user_id', 'topic_id')->withTimeStamps();
    }

}
