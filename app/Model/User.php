<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use Notifiable;
    //    1.用户模型关联表
    public $table = 'user';

    //    2.关联表的主键

    public $primaryKey = 'id';

    /**
     * 允许被批量操作的字段
     *
     * @var array
     */
//    protected $fillable = [//允许操作的字段//  ----为什么用上面这个方法调用的时候只能用post？
//        'id','num', 'name','gender','phone','password','money'
//    ];
    public $guarded = [];//不允许操作的字段
//4.禁用时间戳
    public $timestamps = false;//不维护crated_at 和updated_at字段

}
