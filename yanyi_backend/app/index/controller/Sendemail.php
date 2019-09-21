<?php

namespace app\index\controller;

use think\Controller;
use think\Cookie;
use think\Request;
use think\Session;
use app\index\model\UserInfo;

class Sendemail extends Controller
{
    public function sendemail(Request $request)
    {
        // 请求本地链接时需要加，防止跨域
        header("Access-Control-Allow-Origin:*");
        // 开始生成验证码
        $user_email = $request->get('email');
        $user_status = $request->get('status');
        $info = UserInfo::get($user_email);
        if(!filter_var($user_email,FILTER_VALIDATE_EMAIL))
        {
            return "邮箱格式有误！";
        }
        else if($info && $user_status)
        {
            return "该邮箱已被注册！";
        }
        else if(!count($info) && !$user_status)
        {
            return "用户不存在！";
        }
        else if($info && !$user_status)     // 密码找回
        {
            $code = "";
            $seed = time();
            srand($seed);
            for ($i = 0; $i < 4; $i++) {
                $code .= rand(0, 9);
            }
            // cookie加密
            $co = md5($code);
            // 设置Cookie 生存时间 5min（配置中设置）并使用md5加密，防止盗用
            Cookie::set('code', $co);
            // 发送邮件
            Session::set('email', $user_email);
            $subj = "“衍易”APP修改密码";
            $mess = "欢迎使用“衍易”APP！您本次的验证码为：" . $code . "请在 5 分钟内完成修改！";
            $a = mail($user_email, $subj, $mess, 'From:', "1679689986@qq.com");
            if($a)
            {
                return "验证码发送成功！";
            }
            else
            {
                return "验证码发送失败！";
            }
        }
        else {                              // 用户注册
            $code = "";
            $seed = time();
            srand($seed);
            for ($i = 0; $i < 4; $i++) {
                $code .= rand(0, 9);
            }
            // cookie加密
            $co = md5($code);
            // 设置Cookie 生存时间 5min（配置中设置）并使用md5加密，防止盗用
            Cookie::set('code', $co);
            // 发送邮件
            Session::set('email', $user_email);
            $subj = "“衍易”APP注册";
            $mess = "欢迎使用“衍易”APP！您本次的注册验证码为：" . $code . "请在 5 分钟内完成注册！";
            $a = mail($user_email, $subj, $mess, 'From:', "1679689986@qq.com");
            if($a)
            {
                return "验证码发送成功！";
            }
            else
            {
                return "验证码发送失败！";
            }
        }
    }
}