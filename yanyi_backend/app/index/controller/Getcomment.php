<?php

namespace app\index\controller;

use app\index\model\Forum;
use think\Controller;
use think\Request;

class Getcomment extends Controller
{
    function getcomment(Request $request)
    {
        // 请求本地链接时需要加，防止跨域，具体原理不清楚
        header("Access-Control-Allow-Origin:*");

        $num = $request->get('num');
        $article = Forum::get($num);
        // 暂时放着
        $article = $article->toArray();

        $com_text = $article['comment_text'];
        return $com_text;
    }
}