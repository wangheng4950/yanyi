<?php

namespace app\index\controller;

class Index
{
    public function index()
    {
        // 请求本地链接时需要加，防止跨域，具体原理不清楚
        // header("Access-Control-Allow-Origin:*");
        // UserInfo::update(['pass'=>md5('wangheng')],['email'=>'1679689986@qq.com']);
        return '欢迎使用“衍易”APP，这只是后端的 index模块下的 Index控制器下的 index方法。';
    }

}
