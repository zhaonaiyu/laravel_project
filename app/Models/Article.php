<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
     //与模型关联的数据表
    protected $table = 'articles';
    //是否开启自动维护时间戳 false 不开启 true 开启
    public $timestamps = false;
    //可以被批量赋值的属性(数据表的字段),属性必须要写，否则无法插入数据
    protected $fillable = ['title','descr','thumb','editor'];
}
