<?php

namespace app\admin\model;

use think\Model;


class Plan extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $table = 'plan';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'IS_EFFECTIVE_text'
    ];
    

    
    public function getIsEffectiveList()
    {
        return ['0-失效' => __('失效'), '1-正常' => __('正常'), '2-已删除' => __('已删除'), '3-锁定' => __('锁定'), '4-锁定（余额不足）' => __('锁定（余额不足）')];
    }


    public function getIsEffectiveTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['IS_EFFECTIVE']) ? $data['IS_EFFECTIVE'] : '');
        $list = $this->getIsEffectiveList();
        return isset($list[$value]) ? $list[$value] : '';
    }




}
