<?php

return [
    'Id'              => '主键',
    'Ad_name'         => '名称',
    'Plan_id'         => '所属计划',
    'Spend_type'      => '计费类型 cpv,cpc',
    'Style_id'        => '广告样式',
    'Image_url'       => '图片地址',
    'Click_url'       => '跳转地址',
    'Ad_user_price'   => '广告主单价',
    'Site_user_price' => '网站主单价',
    'Visible_type'    => '用户可见类型 0-全部用户生效,1-指定用户,2-排除用户,3-指定用户组,4-排除用户组,5-指定用户等级,6-排除用户等级',
    'Visible_scope'   => '用户可见范围 结合type使用,多个以,拼接',
    'Point_ratio'     => '扣点比例 单位%',
    'Ad_size'         => '宽x高',
    'Valid_time'      => '生效时段 0-1点为0,多个以,分隔',
    'Push_num_limit'  => '推送次数限制 对同一站长推送次数限制,达到限制之后停止此广告推送',
    'Change_num'      => '推送改变间隔次数 广告推送改变间隔次数',
    'Change_time'     => '推送改变间隔时间 广告推送改变间隔时间,秒值',
    'Hidden_js_ids'   => '隐藏广告代码',
    'Weight'          => '1~10数字,默认为1,权重越高,显示的机率越大',
    'Creat_time'      => '创建时间',
    'Update_time'     => '修改时间',
    'Is_effective'    => '是否有效；0-失效,1-有效,2-已删除',
    'Order_num'       => '排序',
    'User_id'         => '广告所属用户id'
];
