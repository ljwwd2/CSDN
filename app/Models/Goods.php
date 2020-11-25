<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//class Goods extends Authenticatable
class Goods extends Model
{
    use Notifiable;
//    1.用户模型关联表
    public $table = 'blog_goods';
//    2.关联表的主键

    public $primaryKey = 'id';

    /**
     * 允许被批量操作的字段
     *
     * @var array
     */
//    protected $fillable = [//允许操作的字段
//        'name', 'place','date','phone','picture','text','id'
//    ];
    public $guarded = [];//不允许操作的字段
//4.禁用时间戳
    public $timestamps = false;//不维护crated_at 和updated_at字段



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'remember_token',
//    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];
}
