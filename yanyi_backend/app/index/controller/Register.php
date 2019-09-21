<?php

namespace app\index\controller;

use app\index\model\UserInfo;
use think\Controller;
use think\Cookie;
use think\Request;
use think\Session;

class Register extends Controller
{
    public function register(Request $request)
    {
        // 请求本地链接时需要加，防止跨域，具体原理不清楚
        header("Access-Control-Allow-Origin:*");
        // 开始注册
        $email = $request->get('email');
        $code = $request->get('code');
        $pass1 = $request->get('pass1');
        $pass2 = $request->get('pass2');
        $cookie_code = Cookie::get('code');
        $session_email = Session::get('email');

        // 判断密码中是否有数字和字母以及位数是否满足要求
        $check_num = 0;
        $check_str = 0;
        $check_count = 0;
        if(strlen($pass1)>8 && strlen($pass1)<30)
            $check_count = 1;
        for($i = 0;$i < strlen($pass1);$i++)
        {
            if($pass1[$i] >= '0' && $pass1[$i] <= '9')
                $check_num = 1;
            else if($pass1[$i] >= 'a' && $pass1[$i] <= 'z')
                $check_str = 1;
        }
        $info = UserInfo::get($email);

        if(strlen($email) <= 0)
        {
            return '邮箱不能为空！';
        }
        else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            return "邮箱格式有误！";
        }
        else if($info)
        {
            return "该邮箱已被注册！";
        }
        else if(strlen($code) <= 0)
        {
            return '请输入验证码！';
        }/* 因手机模拟有误，暂时备注，完成后取消备注
        else if($email != $session_email)
        {
            return "邮箱与注册邮箱不一致！";
        }
        else if(!$cookie_code)
        {
            return '验证码失效！';
        }
        else if(md5($code) != $cookie_code)
        {
            return '验证码输入错误！';
        }*/
        else if(!$check_count)
        {
            return '密码位数不足！';
        }
        else if(!$check_num)
        {
            return '密码中缺少数字！';
        }
        else if(!$check_str)
        {
            return '密码中缺少字母！';
        }
        else if($pass1 != $pass2)
        {
            return '两次密码输入不一致！';
        }
        else
        {
            // 验证码使用后删除记录以访违法使用
            Cookie::set('code','');
            // 数据库添加数据
            $pass = md5($pass1);
            UserInfo::create([
                'email' =>  $email,
                'pass'  =>  $pass
            ]);
            return '1';
        }
    }
}