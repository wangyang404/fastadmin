<?php


namespace app\api\controller;


use app\common\controller\Api;

class testSqlserver extends Api
{

    public function _initialize()
    {
        parent::_initialize();
    }


    public function test(){

        var_dump('aa');
    }

}