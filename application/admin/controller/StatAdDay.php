<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;

/**
 * 每日广告统计管理
 *
 * @icon fa fa-circle-o
 */
class StatAdDay extends Backend
{
    
    /**
     * StatAdDay模型对象
     * @var \app\admin\model\StatAdDay
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\StatAdDay;

    }

    /**
     * 查看
     */
    public function index()
    {
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                ->where($where)
                ->order($sort, $order)
                ->count();

//            $list = $this->model
//                ->where($where)
//                ->order($sort, $order)
//                ->limit($offset, $limit)
//                ->select();

//            //根据计划统计
            $sql = 'SELECT STAT_DATE, SUM(PV_NUM) as PV_NUM,SUM(UV_NUM) as UV_NUM,SUM(IP_NUM) as IP_NUM,SUM(CLICK_NUM) as CLICK_NUM,SUM(CLICK_UV_NUM) as CLICK_UV_NUM,
                    SUM(CLICK_IP_NUM) as CLICK_IP_NUM,SUM(AD_USER_SPEND) as AD_USER_SPEND,SUM(SITE_USER_PROFIT) as SITE_USER_PROFIT,
                    SUM(ADMIN_USER_PROFIT) as ADMIN_USER_PROFIT,SUM(CUSTOMER_USER_PROFIT) as CUSTOMER_USER_PROFIT,SUM(BUSINESS_USER_PROFIT) as BUSINESS_USER_PROFIT
                    FROM stat_ad_day 
                    GROUP BY STAT_DATE having STAT_DATE = 20210528 ORDER BY STAT_DATE DESC';



            $list = Db::query($sql);

            $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    

}
