<?php


namespace app\api\controller;


use app\common\controller\Api;
use think\Db;

class Site extends Api
{

    protected $noNeedLogin = ['getSiteList'];
    protected $noNeedRight = '*';


    public function _initialize()
    {
        parent::_initialize();
    }

    public function isDomain($domain)
    {
        return !empty($domain) && strpos($domain, '--') === false &&
        preg_match('/^([a-z0-9]+([a-z0-9-]*(?:[a-z0-9]+))?\.)?[a-z0-9]+([a-z0-9-]*(?:[a-z0-9]+))?(\.us|\.tv|\.org\.cn|\.org|\.net\.cn|\.net|\.mobi|\.me|\.la|\.info|\.hk|\.gov\.cn|\.edu|\.com\.cn|\.com|\.co\.jp|\.co|\.cn|\.cc|\.biz)$/i', $domain) ? true : false;
    }


    public function addStie(){

        $site_name = $this->request->request('site_name');
        $site_url = $this->request->request('site_url');
        //校验域名是否正确
        $isDomain = $this->isDomain($site_url);
        if(!$isDomain){
            $this->error('域名不正确');
        }

        $site_type = $this->request->request('site_type');
        //查询是否存在

        if(!empty($site_url)){
            $result = Db::table('site')->where('SITE_URL', $site_url)->field('*')->select();
            if($result){
                $this->error('该站点已经存在');
            }
        }

        $userinfo = $this->auth->getUserinfo();
        $userId = $userinfo['id'];

        $data = [
                    'USER_ID'=>$userId,
                    'SITE_NAME'=>$site_name,
                    'SITE_TYPE'=>$site_type,
                    'IS_EFFECTIVE'=>0,
                    'SITE_URL'=>$site_url,
                    'CREATE_TIME'=>date('Y-m-d H:i:s')
                ];


        $res = Db::table('site')->insert($data);

        if ($res==1){
            $this->success('新增站点成功');
        }

        $this->error('新增站点失败');

    }

    //获取网站类型
    public function getSiteType(){
        $siteTypeList = Db::table('site_class')->select();
        $this->success('网站类型',$siteTypeList);

    }

    //网站列表

    public function getSiteList(){
        $userinfo = $this->auth->getUserinfo();
        $list = Db::table('site')->where('USER_ID','=',$userinfo['id'])->select();
        $this->success('网站列表',$list);
    }

}