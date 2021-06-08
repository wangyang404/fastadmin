<?php


namespace app\api\controller;


use app\admin\model\VisitRecord;
use app\common\controller\Api;
use think\Db;
use think\Exception;


class Stats extends Api
{
    protected $noNeedLogin = ['getCategory'];
    protected $noNeedRight = '*';


    public function _initialize()
    {
        parent::_initialize();
    }


        /*public function dayRevenue()
    {


        $userinfo = $this->auth->getUserinfo();

        //今日收入

        $todayRevenue = Db::table('stat_ad_day')->whereTime('CREATE_TIME', 'today')->where('USER_ID',$userinfo['id'])->sum('SITE_USER_PROFIT');

        //账户余额 当天 + 未结算

        $remaining = Db::table('sys_user')->where('id',$userinfo['id'])->field('BALANCE') -> select();

        //查询统计表今日7天的收入 最近7天的PV

        $query = Db::table('stat_ad_day')->whereTime('CREATE_TIME', '>', '-7 days')->where('USER_ID',$userinfo['id'])->field('STAT_DATE,PV_NUM,SITE_USER_PROFIT')->select();

        //广告主广告个数

        $sql = 'SELECT COUNT(1) as count FROM ad a 
                LEFT JOIN  plan p
                ON p.ID = a.`PLAN_ID` 
            WHERE p.`USER_ID` = '.$userinfo['id'];

        $adCount = Db::query($sql);

        $content = [
            'adCount' => $adCount[0]['count'],
            'todayRevenue'    => $todayRevenue,
            'lastdayRevenue' => $remaining[0]['BALANCE'],
            'recentData'  =>$query,

        ];
        $this->success('首页数据', $content);

    }*/


    //近两日统计
    public function dayRevenue(){
        $userinfo = $this->auth->getUserinfo();
        //今日收入

        $todayRevenue = Db::table('stat_ad_day')->whereTime('CREATE_TIME', 'today')->where('USER_ID',$userinfo['id'])->sum('SITE_USER_PROFIT');

        //账户余额 当天 + 未结算

        $remaining = Db::table('sys_user')->where('id',$userinfo['id'])->field('BALANCE') -> select();

        //广告主广告个数

        $sql = 'SELECT COUNT(1) as count FROM ad a 
                LEFT JOIN  plan p
                ON p.ID = a.`PLAN_ID` 
            WHERE p.`USER_ID` = '.$userinfo['id'];

        $adCount = Db::query($sql);
        $content = [
            'adCount'    => $adCount,
            'todayRevenue'    => $todayRevenue,
            'lastdayRevenue' => $remaining[0]['BALANCE'],

        ];
        $this->success('统计数据', $content);

    }

    //近7日统计
    public function recentData(){
        $userinfo = $this->auth->getUserinfo();
        //今日收入

        $query = Db::table('stat_ad_day')->whereTime('CREATE_TIME', '>', '-7 days')->where('USER_ID',$userinfo['id'])->field('STAT_DATE,PV_NUM,SITE_USER_PROFIT')->select();

        $this->success('统计数据', $query);

    }



    //数据报表每天统计
    public function dayStats(){

        //日期
        $beginDate = $this->request->request('beginDate');
        $endDate = $this->request->request('endDate');

        $pageIndex = $this->request->request('pageIndex');
        $pageSize = $this->request->request('pageSize');

        //广告ID
        $adId = $this->request->request('ad_id');

        $userinfo = $this->auth->getUserinfo();

        if(!empty($adId)){

            $where['USER_ID'] = $userinfo['id'];
            $where['AD_ID'] = $adId;
            $query = Db::table('stat_ad_day')->where($where)->whereBetween('STAT_DATE',[$beginDate,$endDate])->limit(intval($pageIndex)-1,$pageSize)->field('STAT_DATE,PV_NUM,UV_NUM,IP_NUM,CLICK_NUM,CLICK_UV_NUM,CLICK_IP_NUM,SITE_USER_PROFIT')->select();
            $count = Db::table('stat_ad_day')->where($where)->whereBetween('STAT_DATE', [$beginDate, $endDate])->count('1');

            $data['data'] = $query;
            $data['count'] = $count;
            $this->success('每日统计',$data);

        }

        //日期统计（根据ID和日期）
//        $query = Db::table('stat_ad_day')->where($where)->whereBetween('STAT_DATE',[$beginDate,$endDate])->field('STAT_DATE,AD_NAME,PV_NUM,SITE_USER_PROFIT')->select();
        $sql = 'SELECT a.STAT_DATE STAT_DATE, SUM(a.PV_NUM) PV_NUM,SUM(a.UV_NUM) UV_NUM,SUM(a.IP_NUM) IP_NUM,SUM(a.CLICK_NUM) CLICK_NUM,SUM(a.CLICK_UV_NUM) CLICK_UV_NUM,SUM(a.CLICK_IP_NUM) CLICK_IP_NUM,SUM(a.SITE_USER_PROFIT) SITE_USER_PROFIT
                FROM (SELECT * FROM stat_ad_day WHERE user_id = '.$userinfo['id'].' AND STAT_DATE BETWEEN '.$beginDate.' AND '.$endDate.') AS a 
                GROUP BY a.STAT_DATE limit '.(intval($pageIndex)-1).','.$pageSize;

        $sql1 = 'SELECT count(*)
                FROM (SELECT * FROM stat_ad_day WHERE user_id = '.$userinfo['id'].' AND STAT_DATE BETWEEN '.$beginDate.' AND '.$endDate.') AS a 
                GROUP BY a.STAT_DATE';

        $data = Db::query($sql);
        $count = Db::query($sql1);

        $data_res['data'] = $data;
        $data_res['count'] = $count;


        $this->success('每日统计',$data_res);
    }

    //点击ip统计
    public function IPList(){

        $userinfo = $this->auth->getUserinfo();

        $userId = $userinfo['id'];

        $visitRecordModel = new VisitRecord();
        $where = ['SITE_USER_ID' => $userId];

        //根据时间段查询
        $startTime = $this->request->request('startTime');
        $endTime = $this->request->request('endTime');

        $planId = $this->request->request('planId');

        //根据广告查询
        if(!empty($planId)){

            $where = ['PLAN_ID' => $planId];
        }

        if(!empty($startTime) && !empty($endTime)){

            $visitRecordModel->whereTime('CREATE_TIME', 'between', ['2021-05-16 00:00:00','2021-05-18 24:00:00']);
        }

        $visitRecord  = $visitRecordModel->where($where) ->select();

        $this->success(('IPList'), $visitRecord);



    }

    //有效 无效
    public function valid(){
        //1有效 0无效
        $valid = $this->request->request('valid');

        $userinfo = $this->auth->getUserinfo();
//        var_dump($userinfo['']);
        $where = array('IS_VALID' => $valid, 'SITE_USER_ID' => $userinfo['id']);

        $visitRecordModel = new VisitRecord();
        $visitRecord  = $visitRecordModel->where($where) ->select();
        $this->success(('有效无效点击查询'), $visitRecord);
    }


    //结算
    public function doPay(){
        //查询所有符合条件的广告主
        $userList = Db::table('sys_user')->where('BALANCE','>','100')->where('IS_EFFECTIVE','=','1')->where('USER_TYPE','=','0')->select();

//         $this->success($userList);

        //开启事务
        Db::startTrans();
        try {

        foreach ($userList as $k => $v){
        //查询是否已经结算过
            $day = date ( 'Y-m-d', time());

            $where = ['addtime' => $day,
                'uid' => $v['id']
                ];

            $result = Db::table('pay_log')->where($where)->select();
           if(empty($result)){

            //查询下线
               $recommendUserId = Db::table('sys_user')->where('recommend', '=', $v['id'])->column('id');
               //下线提成
               $money = 0;
               //下线当天收益总和
               if(!empty($recommendUserId)){
                   $sumXmoney = Db::table('sys_user')->whereIn('id',$recommendUserId)->sum('BALANCE');
                   //比例待修改
                   $money = $sumXmoney + $v['SITE_DAY_MONEY'] * 0.3;
               }

               //加paylog表

            $data = [ 'uid' => $v['id'],

                'money' =>$v['SITE_DAY_MONEY'],
                'pay' => $v['SITE_DAY_MONEY'] + $sumXmoney,
                //todo 下线收入 修改比例
                'xmoney' => $sumXmoney,
                'addtime' => $day,
                'status' => 0,
                'paytype'=>$v['SITE_PAY_TYPE']
                    ];
               Db::table('pay_log')->insert($data);

               ////扣钱为0
               $update_data = [ 'id' =>  $v['id'],
                   'SITE_DAY_MONEY' => 0 ];

               Db::table('sys_user')->update($update_data);
               //关闭事务

           }

        }
            Db::commit();
        } catch (Exception $e) {
            Db::rollback();
            $this->error($e->getMessage());
        }


        return $this->success('结算成功');
    }

        //驳回 1.直接封禁数据清0  2 账号封禁   数据不动 3 账号封禁  被封金额返还给 之前消耗的广告主
        public function refund(){
        if(1){
            //直接封禁数据清0
        }elseif (2){
            //账号封禁   数据不动
        }elseif (3){
            //3 账号封禁  被封金额返还给 之前消耗的广告主
        }

        }

        public function getAds(){
            $userinfo = $this->auth->getUserinfo();
        $sql = 'SELECT a.ID,a.AD_NAME FROM ad a
                LEFT JOIN  plan p ON p.ID = a.PLAN_ID WHERE p.USER_ID = '.$userinfo['id'];

            $data = Db::query($sql);
            $this->success('用户广告信息',$data);
        }




}