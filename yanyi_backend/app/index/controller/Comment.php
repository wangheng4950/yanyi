<?php

namespace app\index\controller;

use app\index\model\Forum;
use think\Controller;
use think\Request;

class Comment extends Controller
{
    function comment(Request $request)
    {
        // 请求本地链接时需要加，防止跨域，具体原理不清楚
        header("Access-Control-Allow-Origin:*");
        $email = $request->get('email');
        $text = $request->post('text');
        // 得到文章序号
        $num = $request->get('num');

        $article = Forum::get($num);
        // 此处不一定需要，暂时放着，待测试后确定
        $article = $article->toArray();

        // 评论数加一
        $com_count = $article['commemt']+1;
        Forum::update([
            'comment'   =>  $com_count
        ],['Num'=>$num]);

        // 评论内容更新(不完善版本，应改为json格式方便前端处理)
        $com_text = $article['comment_text'].$email.$text;
        Forum::update([
            'comment_text'  =>  $com_text
        ],['Num'=>$num]);
        // return 值判断
        if() {
            return 1;
        }
        else{
            return 0;
        }
    }
}