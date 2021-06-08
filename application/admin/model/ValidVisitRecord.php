<?php

namespace app\admin\model;

use think\Model;


class ValidVisitRecord extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $table = 'visit_record';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [

    ];
    

    







}
