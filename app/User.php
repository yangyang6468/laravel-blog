<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const CREATED_AT = 'createtime';
    const UPDATED_AT = 'updatetime';

    protected $dateFormat = 'U';
    protected $table = 'cmf_userinfos';

    /**
     * The attributes that are mass assignable.
     * 白名单
     * fillable 与 guarded 只限制了 create 方法，而不会限制 save。
     * @var array
     */
    protected $fillable = [
        'nickname', 'email', 'password' , 'ip' , 'lastlogindate'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'userpwd'
//    ];
}
