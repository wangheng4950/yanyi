<?php

namespace app\index\controller;

use app\index\model\UserInfo;
use think\Controller;
use think\Request;

class Check extends Controller
{
    public function check(Request $request)
    {
        // 请求本地链接时需要加，防止跨域，具体原理不清楚
        header("Access-Control-Allow-Origin:*");
        $email = $request->get('email');
        $info = UserInfo::get($email);
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            return "邮箱格式有误！";
        else if($info)
        {
            return "该邮箱已被注册！";
        }
        else
        {
            return "";
        }
        /*
        $em = Db::table('user_info')->column('email');
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            return "邮箱格式错误";
        foreach ($em as $e) {
            if($email == $e)
                return "该邮箱已被注册！";
        }
        */
    }
}