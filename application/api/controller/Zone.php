<?php


namespace app\api\controller;


use app\common\controller\Api;
use think\Db;

class Zone extends Api
{
    protected $noNeedLogin = ['IPList'];
    protected $noNeedRight = '*';
    public function getType(){


    }

    //新增广告
    public function addZone(){

        $AD_CLASS_ID = $this->request->request('AD_CLASS_ID');
        $SPEND_TYPE = $this->request->request('SPEND_TYPE');
        $AD_SIZE = $this->request->request('AD_SIZE');
        $AD_STYLE_ID = $this->request->request('AD_STYLE_ID');
        $SITE_USER_ID = $this->request->request('SITE_USER_ID');

        $data = [
            'SITE_USER_ID'=>$SITE_USER_ID,
            'AD_CLASS_ID'=>$AD_CLASS_ID,
            'SPEND_TYPE'=>$SPEND_TYPE,
            'AD_SIZE'=>$AD_SIZE,
            'AD_STYLE_ID'=>$AD_STYLE_ID,
            'CREATE_TIME'=>date('Y-m-d H:i:s')
        ];

        $res = Db::table('site_zone')->insert($data);

        if ($res==1){
            $this->success('新增广告位成功');
        }

        $this->error('新增广告位失败');
    }




}