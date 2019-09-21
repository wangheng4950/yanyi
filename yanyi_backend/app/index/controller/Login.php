<?php

namespace app\index\controller;

use think\Controller;
use app\index\model\UserInfo;
use think\Request;
use think\Session;

class Login extends Controller
{
    public function login(Request $request)
    {
        // 请求本地链接时需要加，防止跨域，具体原理不清楚
        header("Access-Control-Allow-Origin:*");
        $email = $request->get('email');
        $pass = $request->get('pass');
        $info = UserInfo::get($email);
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            return "邮箱格式有误";
        }
        else if($info)
        {
            $pass = md5($pass);
            if($pass != $info['pass'])
            {
                return "密码错误！";
            }
            else
            {
                // 密码后缀
                $key_plus = md5($email.'yanyi');
                // 设置session
                Session::set('email',$email);
                Session::set('code',$pass.$key_plus);
                return "1";
            }
        }
        else
        {
            return "邮箱不存在！";
        }
    }
}