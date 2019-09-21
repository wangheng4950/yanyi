<?php

namespace app\index\controller;

use app\index\model\Forum;
use think\Controller;
use think\Request;

class Like extends Controller
{
    function like(Request $request)
    {
        $num = $request->get('num');
        $article = Forum::get($num);

        $article = $article->toArray();

        $like = $article['like']+1;
        Forum::update([
            'like'  =>  $like
        ],['Num'=>$num]);

        // 判断是否点赞成功
        if(){
            return 1;
        }
        else{
            return 0;
        }
    }
}