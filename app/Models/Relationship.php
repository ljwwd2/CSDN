<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{

//    1.用户模型关联表
    public $table = 'blog_relationship';
//    2.关联表的主键

    public $primaryKey = 'id';

    /**
     * 允许被批量操作的字段
     *
     * @var array
     */
//    protected $fillable = [//允许操作的字段
//    ];
    public $guarded = [];//不允许操作的字段
//4.禁用时间戳
    public $timestamps = false;//不维护crated_at 和updated_at字段

}
