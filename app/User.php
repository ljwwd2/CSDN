<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
//    1.用户模型关联表
    public $table = 'blog_user';
//    2.关联表的主键

public $primaryKey = 'id';

    /**
     * 允许被批量操作的字段
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password','truename','phone'
    ];
//4.禁用时间戳
    public $timestamps = false;



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
