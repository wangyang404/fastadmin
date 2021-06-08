<?php

namespace app\api\controller;

use app\common\controller\Api;
use app\common\library\Ems;
use app\common\library\Sms;
use fast\Random;
use Monolog\Handler\Mongo;
use think\captcha\Captcha;
use think\Cookie;
use think\Db;
use think\Session;
use think\Validate;


/**
 * 会员接口
 */
class User extends Api
{
    protected $noNeedLogin = ['login', 'mobilelogin', 'register', 'resetpwd', 'changeemail', 'changemobile', 'third','captcha','getCaptcha','mongo'];
    protected $noNeedRight = '*';

    public function _initialize()
    {
        parent::_initialize();
    }

    /**
     * 会员中心
     */
    public function index()
    {
        $this->success('', ['welcome' => $this->auth->nickname]);
    }

    /**
     * 会员登录
     *
     * @param string $account  账号
     * @param string $password 密码
     */
    public function login()
    {
        $account = $this->request->request('account');
        $password = $this->request->request('password');
        $captcha = $this->request->post('captcha');
        if (!$account || !$password) {
            $this->error(__('Invalid parameters'));
        }

        $rule = [
            'captcha'   => 'require|captcha',
        ];

        $msg = [
            'captcha.require'  => 'Captcha can not be empty',
            'captcha.captcha'  => 'Captcha is incorrect',
        ];

        $data = [
            'captcha'   => $captcha,
        ];

        $validate = new Validate($rule, $msg);

        $result = $validate->check($data);

        if (!$result) {
            $this->error(__($validate->getError()), null);
        }

        $ret = $this->auth->login($account, $password);


        if ($ret) {

            $data = $this->auth->getUserinfo();

            $this->success(__('Logged in successful'), $data);
        } else {
            $this->error($this->auth->getError());
        }
    }

    public function getUserInfo(){

        $userinfo = $this->auth->getUserinfo();
        $this->success(__('用户信息'), $userinfo);

    }

    /**
     * 手机验证码登录
     *
     * @param string $mobile  手机号
     * @param string $captcha 验证码
     */
    public function mobilelogin()
    {
        $mobile = $this->request->request('mobile');
        $captcha = $this->request->request('captcha');
        if (!$mobile || !$captcha) {
            $this->error(__('Invalid parameters'));
        }
        if (!Validate::regex($mobile, "^1\d{10}$")) {
            $this->error(__('Mobile is incorrect'));
        }
        if (!Sms::check($mobile, $captcha, 'mobilelogin')) {
            $this->error(__('Captcha is incorrect'));
        }
        $user = \app\common\model\User::getByMobile($mobile);
        if ($user) {
            //如果已经有账号则直接登录
            $ret = $this->auth->direct($user->id);
        } else {
            $ret = $this->auth->register($mobile, Random::alnum(), '', $mobile, []);
        }
        if ($ret) {
            Sms::flush($mobile, 'mobilelogin');
            $data = ['userinfo' => $this->auth->getUserinfo()];
            $this->success(__('Logged in successful'), $data);
        } else {
            $this->error($this->auth->getError());
        }
    }



    /**
     * 注册会员
     *
     * @param string $username 用户名
     * @param string $password 密码
     * @param string $email    邮箱
     * @param string $mobile   手机号
     */

    public function register()
    {
//        halt($this->request->param()); 

        $username = $this->request->post('username');
        $password = $this->request->post('password');

        $email = $this->request->post('email');
        $mobile = $this->request->post('mobile');
        $captcha = $this->request->post('captcha');
        $userType = $this->request->post('userType');
        if($userType=='true'){
            $userType = 1;
        }else {
        $userType = 0;
        }



        if (!$username || !$password) {
            $this->error(__('Invalid parameters'));
        }
        if ($email && !Validate::is($email, "email")) {
            $this->error(__('Email is incorrect'));
        }
        if ($mobile && !Validate::regex($mobile, "^1\d{10}$")) {
            $this->error(__('Mobile is incorrect'));
        }

        $rule = [
            'username'  => 'require|length:3,30',
            'password'  => 'require|length:6,30',
            'email'     => 'require|email',
            'mobile'    => 'regex:/^1\d{10}$/',
            'captcha'   => 'require|captcha',
        ];

        $msg = [
            'username.require' => 'Username can not be empty',
            'username.length'  => 'Username must be 3 to 30 characters',
            'password.require' => 'Password can not be empty',
            'password.length'  => 'Password must be 6 to 30 characters',
            'captcha.require'  => 'Captcha can not be empty',
            'captcha.captcha'  => 'Captcha is incorrect',
            'email'            => 'Email is incorrect',
            'mobile'           => 'Mobile is incorrect',
        ];
        $data = [
            'username'  => $username,
            'password'  => $password,
            'email'     => $email,
            'mobile'    => $mobile,
            'captcha'   => $captcha,
            'USER_TYPE'   => $userType,
        ];

        $validate = new Validate($rule, $msg);

        $result = $validate->check($data);

        if (!$result) {
            $this->error(__($validate->getError()), null);
        }
        
        $ret = $this->auth->register($username, $password, $email, $mobile,$userType, []);

        if ($ret) {
            $data = ['userinfo' => $this->auth->getUserinfo()];
            $this->success(__('Sign up successful'), $data);
        } else {
            $this->error($this->auth->getError());
        }
    }

    /**
     * 注销登录
     */
    public function logout()
    {
        $this->auth->logout();
        $this->success(__('Logout successful'));
    }

    /**
     * 修改会员个人信息
     *
     * @param string $avatar   头像地址
     * @param string $username 用户名
     * @param string $nickname 昵称
     * @param string $bio      个人简介
     */
    public function profile()
    {
        $user = $this->auth->getUser();
        $username = $this->request->request('username');
        $nickname = $this->request->request('nickname');
        $bio = $this->request->request('bio');
        $avatar = $this->request->request('avatar', '', 'trim,strip_tags,htmlspecialchars');
        if ($username) {
            $exists = \app\common\model\User::where('username', $username)->where('id', '<>', $this->auth->id)->find();
            if ($exists) {
                $this->error(__('Username already exists'));
            }
            $user->username = $username;
        }
        $user->nickname = $nickname;
        $user->bio = $bio;
        $user->avatar = $avatar;
        $user->save();
        $this->success();
    }

    /**
     * 修改邮箱
     *
     * @param string $email   邮箱
     * @param string $captcha 验证码
     */
    public function changeemail()
    {
        $user = $this->auth->getUser();
        $email = $this->request->post('email');
        $captcha = $this->request->request('captcha');
        if (!$email || !$captcha) {
            $this->error(__('Invalid parameters'));
        }
        if (!Validate::is($email, "email")) {
            $this->error(__('Email is incorrect'));
        }
        if (\app\common\model\User::where('email', $email)->where('id', '<>', $user->id)->find()) {
            $this->error(__('Email already exists'));
        }
        $result = Ems::check($email, $captcha, 'changeemail');
        if (!$result) {
            $this->error(__('Captcha is incorrect'));
        }
        $verification = $user->verification;
        $verification->email = 1;
        $user->verification = $verification;
        $user->email = $email;
        $user->save();

        Ems::flush($email, 'changeemail');
        $this->success();
    }

    /**
     * 修改手机号
     *
     * @param string $email   手机号
     * @param string $captcha 验证码
     */
    public function changemobile()
    {
        $user = $this->auth->getUser();
        $mobile = $this->request->request('mobile');
        $captcha = $this->request->request('captcha');
        if (!$mobile || !$captcha) {
            $this->error(__('Invalid parameters'));
        }
        if (!Validate::regex($mobile, "^1\d{10}$")) {
            $this->error(__('Mobile is incorrect'));
        }
        if (\app\common\model\User::where('mobile', $mobile)->where('id', '<>', $user->id)->find()) {
            $this->error(__('Mobile already exists'));
        }
        $result = Sms::check($mobile, $captcha, 'changemobile');
        if (!$result) {
            $this->error(__('Captcha is incorrect'));
        }
        $verification = $user->verification;
        $verification->mobile = 1;
        $user->verification = $verification;
        $user->mobile = $mobile;
        $user->save();

        Sms::flush($mobile, 'changemobile');
        $this->success();
    }

    /**
     * 第三方登录
     *
     * @param string $platform 平台名称
     * @param string $code     Code码
     */
    public function third()
    {
        $url = url('user/index');
        $platform = $this->request->request("platform");
        $code = $this->request->request("code");
        $config = get_addon_config('third');
        if (!$config || !isset($config[$platform])) {
            $this->error(__('Invalid parameters'));
        }
        $app = new \addons\third\library\Application($config);
        //通过code换access_token和绑定会员
        $result = $app->{$platform}->getUserInfo(['code' => $code]);
        if ($result) {
            $loginret = \addons\third\library\Service::connect($platform, $result);
            if ($loginret) {
                $data = [
                    'userinfo'  => $this->auth->getUserinfo(),
                    'thirdinfo' => $result
                ];
                $this->success(__('Logged in successful'), $data);
            }
        }
        $this->error(__('Operation failed'), $url);
    }

    /**
     * 重置密码
     *
     * @param string $mobile      手机号
     * @param string $newpassword 新密码
     * @param string $captcha     验证码
     */
    public function resetpwd()
    {
        $type = $this->request->request("type");
        $mobile = $this->request->request("mobile");
        $email = $this->request->request("email");
        $newpassword = $this->request->request("newpassword");
        $captcha = $this->request->request("captcha");
        if (!$newpassword || !$captcha) {
            $this->error(__('Invalid parameters'));
        }
        if ($type == 'mobile') {
            if (!Validate::regex($mobile, "^1\d{10}$")) {
                $this->error(__('Mobile is incorrect'));
            }
            $user = \app\common\model\User::getByMobile($mobile);
            if (!$user) {
                $this->error(__('User not found'));
            }
            $ret = Sms::check($mobile, $captcha, 'resetpwd');
            if (!$ret) {
                $this->error(__('Captcha is incorrect'));
            }
            Sms::flush($mobile, 'resetpwd');
        } else {
            if (!Validate::is($email, "email")) {
                $this->error(__('Email is incorrect'));
            }
            $user = \app\common\model\User::getByEmail($email);
            if (!$user) {
                $this->error(__('User not found'));
            }
            $ret = Ems::check($email, $captcha, 'resetpwd');
            if (!$ret) {
                $this->error(__('Captcha is incorrect'));
            }
            Ems::flush($email, 'resetpwd');
        }
        //模拟一次登录
        $this->auth->direct($user->id);
        $ret = $this->auth->changepwd($newpassword, '', true);
        if ($ret) {
            $this->success(__('Reset password successful'));
        } else {
            $this->error($this->auth->getError());
        }
    }

    //站长结算记录
    public function payList(){
        $pageIndex = $this->request->request('pageIndex');
        $pageSize = $this->request->request('pageSize');
        $user = $this->auth->getUserinfo();

        $count =Db::table('pay_log')->where('uid','=',$user['id'])->count(1);
        $list = Db::table('pay_log')->where('uid','=',$user['id'])->limit(intval($pageIndex)-1,$pageSize)->select();

        $data['data'] = $list;
        $data['count'] = $count;

        $this->success('结算记录',$data);
    }


    public function test(){
        session_start();
//1.创建黑色画布
        $image = imagecreatetruecolor(100, 30);

//2.为画布定义(背景)颜色
        $bgcolor = imagecolorallocate($image, 255, 255, 255);

//3.填充颜色
        imagefill($image, 0, 0, $bgcolor);

// 4.设置验证码内容

//4.1 定义验证码的内容
        $content = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

//4.1 创建一个变量存储产生的验证码数据，便于用户提交核对
        $captcha = "";
        for ($i = 0; $i < 4; $i++) {
            // 字体大小
            $fontsize = 10;
            // 字体颜色
            $fontcolor = imagecolorallocate($image, mt_rand(0, 120), mt_rand(0, 120), mt_rand(0, 120));
            // 设置字体内容
            $fontcontent = substr($content, mt_rand(0, strlen($content)), 1);
            $captcha .= $fontcontent;
            // 显示的坐标
            $x = ($i * 100 / 4) + mt_rand(5, 10);
            $y = mt_rand(5, 10);
            // 填充内容到画布中
            imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);
        }
        $_SESSION["captcha"] = $captcha;

//4.3 设置背景干扰元素
        for ($$i = 0; $i < 200; $i++) {
            $pointcolor = imagecolorallocate($image, mt_rand(50, 200), mt_rand(50, 200), mt_rand(50, 200));
            imagesetpixel($image, mt_rand(1, 99), mt_rand(1, 29), $pointcolor);
        }

//4.4 设置干扰线
        for ($i = 0; $i < 3; $i++) {
            $linecolor = imagecolorallocate($image, mt_rand(50, 200), mt_rand(50, 200), mt_rand(50, 200));
            imageline($image, mt_rand(1, 99), mt_rand(1, 29), mt_rand(1, 99), mt_rand(1, 29), $linecolor);
        }

//5.向浏览器输出图片头信息
        header('content-type:image/png');

//6.输出图片到浏览器
        imagepng($image);

        //7.销毁图片
        imagedestroy($image);
    }

    public function captcha()
    {
        $config = [
            'length'=>4,
            'useCurve'=>false,
            'fontSize'=>30,
        ];
        $captcha = new Captcha();
        $re = $captcha->entry();
        var_dump($re);
        exit();
        $base64 = 'data:image/png;base64,' . base64_encode($re->getData());

        return $this->success('验证码',$base64);
    }


    public function getCaptcha(){
        session_start();
//1.创建黑色画布
        $image = imagecreatetruecolor(100, 30);

//2.为画布定义(背景)颜色
        $bgcolor = imagecolorallocate($image, 255, 255, 255);

//3.填充颜色
        imagefill($image, 0, 0, $bgcolor);

// 4.设置验证码内容

//4.1 定义验证码的内容
        $content = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

//4.1 创建一个变量存储产生的验证码数据，便于用户提交核对
        $captcha = "";
        for ($i = 0; $i < 4; $i++) {
            // 字体大小
            $fontsize = 10;
            // 字体颜色
            $fontcolor = imagecolorallocate($image, mt_rand(0, 120), mt_rand(0, 120), mt_rand(0, 120));
            // 设置字体内容
            $fontcontent = substr($content, mt_rand(0, strlen($content)), 1);
            $captcha .= $fontcontent;
            // 显示的坐标
            $x = ($i * 100 / 4) + mt_rand(5, 10);
            $y = mt_rand(5, 10);
            // 填充内容到画布中
            imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);
        }
        $_SESSION["captcha"] = $captcha;

//4.3 设置背景干扰元素
        for ($$i = 0; $i < 200; $i++) {
            $pointcolor = imagecolorallocate($image, mt_rand(50, 200), mt_rand(50, 200), mt_rand(50, 200));
            imagesetpixel($image, mt_rand(1, 99), mt_rand(1, 29), $pointcolor);
        }

//4.4 设置干扰线
        for ($i = 0; $i < 3; $i++) {
            $linecolor = imagecolorallocate($image, mt_rand(50, 200), mt_rand(50, 200), mt_rand(50, 200));
            imageline($image, mt_rand(1, 99), mt_rand(1, 29), mt_rand(1, 99), mt_rand(1, 29), $linecolor);
        }

//5.向浏览器输出图片头信息
        header('content-type:image/png');

//6.输出图片到浏览器
        imagepng($image);
        $content = ob_get_clean();
        //        //7.销毁图片
//        imagedestroy($image);
        return response($content, 200, ['Content-Length' => strlen($content)])->contentType('image/png');
    }

}
