<?php

namespace app\common\controller;

// 该模块无法通过url直接访问
// 检查Session是否存在
class CheckSession
{
    public function index()
    {

        return "this is common Index index.";
    }
}