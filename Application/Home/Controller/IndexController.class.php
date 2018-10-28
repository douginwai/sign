<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function test()
    {
        $model = D('student');
        $list = $model->where('1', 1)->select();
        dump($list);
    }
}