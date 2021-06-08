<?php

namespace app\admin\model;

use think\Model;


class Ad extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $table = 'ad';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'VALID_TIME_text',
        'CHANGE_TIME_text'
    ];
    

    



    public function getValidTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['VALID_TIME']) ? $data['VALID_TIME'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getChangeTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['CHANGE_TIME']) ? $data['CHANGE_TIME'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    protected function setValidTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setChangeTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


}
