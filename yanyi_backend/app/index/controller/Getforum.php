<?php

namespace app\index\controller;

use think\Controller;
use app\index\model\Forum;

class Getforum extends Controller
{
    public function getForum()
    {
        // 请求本地链接时需要加，防止跨域，具体原理不清楚
        header("Access-Control-Allow-Origin:*");
        // 得到文章的所有内容，目录处的text部分输出前规定字数即可，副界面将文章全部输出
        $forum = Forum::all();
        return json($forum);
    }
}