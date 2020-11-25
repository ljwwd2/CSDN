<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShopCar extends Model
{
    //1.用户模型关联表
    public $table = 'shopcar';

    //2.关联表的主键
    public $primaryKey = 'id';

    //3.运行操作的字段
//    protected $fillable = [
//        'uid','gid'
//    ];
    //不允许操作的字段
    public $guarded = [];

    //4.禁用时间戳
    public $timestamps = false;

}
